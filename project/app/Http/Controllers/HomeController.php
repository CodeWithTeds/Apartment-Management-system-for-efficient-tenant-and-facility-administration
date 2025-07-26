<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $apartments = Apartment::latest()->get();
        return view('landing', compact('apartments'));
    }
} 