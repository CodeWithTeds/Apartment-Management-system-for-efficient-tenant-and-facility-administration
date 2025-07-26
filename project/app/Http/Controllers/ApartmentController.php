<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function show(Apartment $apartment)
    {
        return view('apartment-view', compact('apartment'));
    }
} 