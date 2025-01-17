<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Events\ActionLogged;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $apartments = Apartment::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('address', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('apartments.index', compact('apartments'));
    }

    public function create()
    {
        return view('apartments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('apartments');
        }

        $apartment = Apartment::create($validated);
        
        event(new ActionLogged(auth()->id(), 'Tạo tòa nhà: ' . $apartment->name));

        return redirect()->route('apartments.index')->with('success', 'Tòa nhà đã được tạo!');
    }

    public function edit(Apartment $apartment)
    {
        return view('apartments.edit', compact('apartment'));
    }

    public function update(Request $request, Apartment $apartment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('apartments');
        }

        $apartment->update($validated);

        return redirect()->route('apartments.index')->with('success', 'Tòa nhà đã được cập nhật!');
    }

    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        event(new ActionLogged(auth()->id(), 'Xóa tòa nhà: ' . $apartment->name));

        return redirect()->route('apartments.index')->with('success', 'Tòa nhà đã bị xóa!');
    }

    public function show($id)
    {
        $apartment = Apartment::findOrFail($id); 
        return view('apartments.show', compact('apartment'));
    }
}

