<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;

class LandingController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Apartment::with('rules')->latest();

        if ($request->has('property_type') && $request->property_type != '') {
            $query->where('property_type', $request->property_type);
        }
        if ($request->has('rent_type') && $request->rent_type != '') {
            $query->where('rent_type', $request->rent_type);
        }
        if ($request->has('pet_policy') && $request->pet_policy != '') {
            $query->where('pet_policy', $request->pet_policy);
        }
        if ($request->has('location') && $request->location != '') {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        if ($request->has('price_from') && $request->price_from != '') {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->has('price_to') && $request->price_to != '') {
            $query->where('price', '<=', $request->price_to);
        }
        if ($request->has('amenities') && $request->amenities != '') {
            $query->where('amenities', 'like', '%' . $request->amenities . '%');
        }

        $apartments = $query->get();

        $totalProperties = Apartment::count();
        $totalUnits = Apartment::sum('total_units');
        $availableUnits = Apartment::sum('available_units');

        $occupiedUnits = $totalUnits - $availableUnits;
        $averageOccupancy = ($totalUnits > 0) ? round(($occupiedUnits / $totalUnits) * 100, 2) : 0;

        $apartmentsForRent = Apartment::where('rent_type', 'for_rent')->get();
        $shortTermStays = Apartment::where('rent_type', 'short_term')->get();
        
        return view('landing', compact('apartments', 'totalProperties', 'totalUnits', 'availableUnits', 'averageOccupancy', 'apartmentsForRent', 'shortTermStays'));
    }
}
