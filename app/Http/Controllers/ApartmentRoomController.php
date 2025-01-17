<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ApartmentRoom;
use Illuminate\Http\Request;
use App\Events\ActionLogged;

class ApartmentRoomController extends Controller
{
    public function index(Request $request, $apartmentId)
    {
        $apartment = Apartment::findOrFail($apartmentId);
        $rooms = $apartment->rooms()
            ->when($request->search, function ($query, $search) {
                $query->where('room_number', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('rooms.index', compact('apartment', 'rooms'));
    }

    public function create($apartmentId)
    {
        $apartment = Apartment::findOrFail($apartmentId);

        return view('rooms.create', compact('apartment'));
    }

    public function store(Request $request, $apartmentId)
    {
        $apartment = Apartment::findOrFail($apartmentId);

        $validated = $request->validate([
            'room_number' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms');
        }

        $room = $apartment->rooms()->create($validated);

        event(new ActionLogged(auth()->id(), 'Tạo phòng trọ: ' . $validated['room_number'] . ' tại tòa nhà: ' . $apartment->name));

        return redirect()->route('rooms.index', $apartment->id)->with('success', 'Phòng trọ đã được thêm!');
    }

    public function edit($apartmentId, $roomId)
    {
        $apartment = Apartment::findOrFail($apartmentId);
        $room = $apartment->rooms()->findOrFail($roomId);

        return view('rooms.edit', compact('apartment', 'room'));
    }

    public function update(Request $request, $apartmentId, $roomId)
    {
        $apartment = Apartment::findOrFail($apartmentId);
        $room = $apartment->rooms()->findOrFail($roomId);

        $validated = $request->validate([
            'room_number' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms');
        }

        $room->update($validated);

        return redirect()->route('rooms.index', $apartment->id)->with('success', 'Phòng trọ đã được cập nhật!');
    }

    public function destroy($apartmentId, $roomId)
    {
        $apartment = Apartment::findOrFail($apartmentId);
        $room = $apartment->rooms()->findOrFail($roomId);

        $room->delete();

        event(new ActionLogged(auth()->id(), 'Xóa phòng trọ: ' . $room->room_number . ' tại tòa nhà: ' . $apartment->name));

        return redirect()->route('rooms.index', $apartment->id)->with('success', 'Phòng trọ đã bị xóa!');
    }
}

