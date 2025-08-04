<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TenantWelcomeMail;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(10);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $inquiry->update($request->only('status'));

        if ($request->status === 'accepted') {
            $password = str()->random(8);

            $user = User::firstOrCreate(
                ['email' => $inquiry->email],
                [
                    'name' => $inquiry->full_name,
                    'password' => bcrypt($password),
                ]
            );

            Mail::to($user->email)->send(new TenantWelcomeMail($user, $password));
        }

        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry status updated successfully.');
    }

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