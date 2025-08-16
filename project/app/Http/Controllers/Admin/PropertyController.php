<?php

namespace App\Http\Controllers\Admin;

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
        $apartments = Apartment::where('admin_id', auth()->id())->latest()->get();
        return view('admin.property.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        $this->authorize('view', $apartment);
        return view('admin.property.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        $this->authorize('update', $apartment);
        $apartment->load('rules');
        return view('admin.property.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $this->authorize('update', $apartment);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'total_units' => 'required|integer',
            'available_units' => 'required|integer',
            'capacity' => 'required|string',
            'rent_type' => 'required|string',
            'pet_policy' => 'required|string',
            'description' => 'required|string',
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

        $apartment->fill($request->except(['image1', 'image2', 'image3', 'image4', 'image5', 'rules']));

        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
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

        return redirect()->route('dashboard')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $this->authorize('delete', $apartment);
        $apartment->delete();
        return redirect()->route('admin.property.index')->with('success', 'Property deleted successfully.');
    }
    
    /**
     * Show bill settings for the specified property.
     */
    public function billSettings(Apartment $apartment)
    {
        $this->authorize('update', $apartment);
        return view('admin.property.bill-settings', compact('apartment'));
    }
    
    /**
     * Update bill settings for the specified property.
     */
    public function updateBillSettings(Request $request, Apartment $apartment)
    {
        $this->authorize('update', $apartment);
        
        $validated = $request->validate([
            'water_bill_toggle' => 'boolean',
            'electric_bill_toggle' => 'boolean',
        ]);
        
        $apartment->update($validated);
        
        return redirect()->route('admin.property.bill-settings', $apartment)->with('success', 'Bill settings updated successfully.');
    }
}
