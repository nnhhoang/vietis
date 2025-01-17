<?php

namespace App\Http\Controllers;

use App\Models\ApartmentRoom;
use App\Models\MonthlyRent;
use Illuminate\Http\Request;

class MonthlyRentController extends Controller
{
    public function index($roomId)
    {
        $room = ApartmentRoom::findOrFail($roomId);
        $rents = $room->rents()->paginate(10);

        return view('rents.index', compact('room', 'rents'));
    }

    public function create($roomId)
    {
        $room = ApartmentRoom::findOrFail($roomId);

        return view('rents.create', compact('room'));
    }

    public function store(Request $request, $roomId)
    {
        $room = ApartmentRoom::findOrFail($roomId);

        $validated = $request->validate([
            'electricity' => 'required|integer|min:0',
            'water' => 'required|integer|min:0',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'electricity_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'water_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('electricity_image')) {
            $validated['electricity_image'] = $request->file('electricity_image')->store('rents');
        }

        if ($request->hasFile('water_image')) {
            $validated['water_image'] = $request->file('water_image')->store('rents');
        }

        $validated['apartment_room_id'] = $roomId;

        MonthlyRent::create($validated);

        return redirect()->route('rents.index', $roomId)->with('success', 'Thông tin tiền trọ đã được thêm!');
    }

    public function edit($roomId, $rentId)
    {
        $room = ApartmentRoom::findOrFail($roomId);
        $rent = $room->rents()->findOrFail($rentId);

        return view('rents.edit', compact('room', 'rent'));
    }

    public function update(Request $request, $roomId, $rentId)
    {
        $room = ApartmentRoom::findOrFail($roomId);
        $rent = $room->rents()->findOrFail($rentId);

        $validated = $request->validate([
            'electricity' => 'required|integer|min:0',
            'water' => 'required|integer|min:0',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'electricity_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'water_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('electricity_image')) {
            $validated['electricity_image'] = $request->file('electricity_image')->store('rents');
        }

        if ($request->hasFile('water_image')) {
            $validated['water_image'] = $request->file('water_image')->store('rents');
        }

        $rent->update($validated);

        return redirect()->route('rents.index', $roomId)->with('success', 'Thông tin tiền trọ đã được cập nhật!');
    }

    public function destroy($roomId, $rentId)
    {
        $room = ApartmentRoom::findOrFail($roomId);
        $rent = $room->rents()->findOrFail($rentId);

        $rent->delete();

        return redirect()->route('rents.index', $roomId)->with('success', 'Thông tin tiền trọ đã bị xóa!');
    }
    
    public function unpaidRooms()
    {
        $lastMonth = now()->subMonth();
        $unpaidRents = MonthlyRent::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->whereColumn('paid_amount', '<', 'total_amount')
            ->with('room')
            ->get();
    
        return view('rents.unpaid', compact('unpaidRents'));
    }
    
}
