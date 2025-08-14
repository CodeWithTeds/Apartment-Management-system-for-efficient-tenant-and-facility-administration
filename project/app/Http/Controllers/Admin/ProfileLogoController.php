<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileLogoController extends Controller
{
    /**
     * Show the form for editing the profile logo.
     */
    public function index()
    {
        return view('admin.profile.logo');
    }

    /**
     * Update the authenticated admin's logo.
     */
    public function update(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ]);

        $user = Auth::user();

        // Only admins/owners can set a logo shown to their tenants
        if (! in_array($user->role, ['admin', 'owner'])) {
            abort(403);
        }

        $path = $request->file('logo')->store('logos', 'public');

        $user->logo_path = $path;
        $user->save();

        return back()->with('success', 'Logo updated successfully.');
    }
}


