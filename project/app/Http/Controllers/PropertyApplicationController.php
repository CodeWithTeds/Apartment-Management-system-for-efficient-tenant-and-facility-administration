<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerifyPropertyApplicationMail;

class PropertyApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'property_name' => 'required|string|max:255',
            'property_address' => 'required|string',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048', // 2MB max size
        ]);

        $documentPath = $request->file('document')->store('property_documents', 'public');
        $verificationToken = Str::random(64);

        $application = PropertyApplication::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'property_name' => $request->property_name,
            'property_address' => $request->property_address,
            'description' => $request->description,
            'document_path' => $documentPath,
            'application_status' => 'unverified',
            'verification_token' => $verificationToken,
        ]);

        // Send verification email
        try {
            Mail::to($request->email)->send(new VerifyPropertyApplicationMail($application));
            \Log::info('Verification email sent to: ' . $request->email);
        } catch (\Exception $e) {
            \Log::error('Failed to send verification email: ' . $e->getMessage());
            return redirect()->route('become-a-property-owner')->with('error', 'Application submitted but verification email could not be sent. Please contact support.');
        }

        return redirect()->route('become-a-property-owner')->with('success', 'Your application has been submitted! Please check your email to verify your application.');
    }

    public function verify($token)
    {
        $application = PropertyApplication::where('verification_token', $token)
            ->where('application_status', 'unverified')
            ->first();

        if (!$application) {
            return redirect()->route('become-a-property-owner')->with('error', 'Invalid or expired verification link.');
        }

        $application->update([
            'application_status' => 'pending',
            'verification_token' => null,
        ]);

        return redirect()->route('become-a-property-owner')->with('success', 'Your application has been verified successfully! It is now under review.');
    }
} 