<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_no' => 'required|string|max:20',
            'stay_type' => 'required|string|in:monthly,short_term',
            'nights' => 'nullable|integer|min:1',
            'occupants' => 'nullable|integer|min:1',
            'message' => 'nullable|string',
        ]);

        Inquiry::create($request->all());

        return back()->with('success', 'Your inquiry has been sent successfully!');
    }
}