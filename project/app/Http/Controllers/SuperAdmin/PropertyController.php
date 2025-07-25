<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::with('owner')->latest()->get();
        return view('superadmin.property', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admins = \App\Models\User::all();
        return view('superadmin.create', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'total_units' => 'required|integer',
            'available_units' => 'required|integer',
            'capacity' => 'required|string',
            'rent_type' => 'required|string',
            'pet_policy' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'property_type' => 'required|string',
            'amenities' => 'required|string',
            'admin_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $apartment = new Apartment($request->all());

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images/apartments'), $imageName);
            $apartment->image = $imageName;
        }

        $apartment->save();

        return redirect()->route('superadmin.property.index')->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        $apartment->load('owner');
        return view('superadmin.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        $admins = \App\Models\User::all();
        return view('superadmin.edit', compact('apartment', 'admins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'total_units' => 'required|integer',
            'available_units' => 'required|integer',
            'capacity' => 'required|string',
            'rent_type' => 'required|string',
            'pet_policy' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'property_type' => 'required|string',
            'amenities' => 'required|string',
            'admin_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $apartment->fill($request->except('image'));

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($apartment->image && file_exists(public_path('images/apartments/' . $apartment->image))) {
                unlink(public_path('images/apartments/' . $apartment->image));
            }

            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images/apartments'), $imageName);
            $apartment->image = $imageName;
        }

        $apartment->save();

        return redirect()->route('superadmin.property.index')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('superadmin.property.index')->with('success', 'Property deleted successfully.');
    }
}
