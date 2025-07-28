<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;

class LandingController extends Controller
{
    public function __invoke()
    {
        $apartments = Apartment::latest()->take(6)->get();
        return view('landing', compact('apartments'));
    }
}
