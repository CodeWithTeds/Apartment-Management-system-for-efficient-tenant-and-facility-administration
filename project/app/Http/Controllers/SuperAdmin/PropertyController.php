<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentRule;
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
            'description' => 'required|string',
            'property_type' => 'required|string',
            'amenities' => 'required|string',
            'admin_id' => 'required|exists:users,id',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rules.*' => 'nullable|string',
            'monthly_price' => 'nullable|numeric',
            'monthly_includes' => 'nullable|string',
            'short_term_price' => 'nullable|numeric',
            'short_term_includes' => 'nullable|string',
            'short_term_minimum_stay' => 'nullable|integer',
        ]);

        // Create a new request with the price field set to monthly_price or 0
        $data = $request->except(['image1', 'image2', 'image3', 'image4', 'image5', 'rules']);
        $data['price'] = $request->input('monthly_price', 0);

        $apartment = new Apartment($data);

        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                $imageName = time() . '_' . $request->file('image' . $i)->getClientOriginalName();
                $request->file('image' . $i)->move(public_path('images/apartments'), $imageName);
                $apartment->{'image' . $i} = $imageName;
            }
        }
        
        $apartment->save();

        if ($request->has('rules')) {
            foreach ($request->rules as $rule) {
                if ($rule) {
                    $apartment->rules()->create(['rule' => $rule]);
                }
            }
        }

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
        $apartment->load('rules');
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
            'description' => 'required|string',
            'property_type' => 'required|string',
            'amenities' => 'required|string',
            'admin_id' => 'required|exists:users,id',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rules.*' => 'nullable|string',
            'monthly_price' => 'nullable|numeric',
            'monthly_includes' => 'nullable|string',
            'short_term_price' => 'nullable|numeric',
            'short_term_includes' => 'nullable|string',
            'short_term_minimum_stay' => 'nullable|integer',
        ]);

        // Get all the data except for images and rules
        $data = $request->except(['image1', 'image2', 'image3', 'image4', 'image5', 'rules']);
        
        // Ensure price is set to a valid value (use monthly_price, or 0 if not provided)
        if (!isset($data['price']) || $data['price'] === null) {
            $data['price'] = $request->input('monthly_price', 0);
            if ($data['price'] === null) {
                $data['price'] = 0; // Default to 0 if both price and monthly_price are null
            }
        }

        $apartment->fill($data);

        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                // Delete old image if it exists
                if ($apartment->{'image' . $i} && file_exists(public_path('images/apartments/' . $apartment->{'image' . $i}))) {
                    unlink(public_path('images/apartments/' . $apartment->{'image' . $i}));
                }

                $imageName = time() . '_' . $request->file('image' . $i)->getClientOriginalName();
                $request->file('image' . $i)->move(public_path('images/apartments'), $imageName);
                $apartment->{'image' . $i} = $imageName;
            }
        }

        $apartment->save();

        $apartment->rules()->delete();
        if ($request->has('rules')) {
            foreach ($request->rules as $rule) {
                if ($rule) {
                    $apartment->rules()->create(['rule' => $rule]);
                }
            }
        }

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