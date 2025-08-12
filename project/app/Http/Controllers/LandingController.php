<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;

class LandingController extends Controller
{
    public function __invoke()
    {
        $apartments = Apartment::with('rules')->latest()->get();
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
