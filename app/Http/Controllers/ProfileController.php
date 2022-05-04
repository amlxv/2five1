<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('settings.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Check whether the email is not verified
        $user = User::find($id);
        if (!$user->email_verified_at) {
            return back()->with('email-is-not-verified', 'Please verify your email first.');
        }

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:12',
            'address' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->has('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_name =  $id . time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images/avatars'), $avatar_name);
            $validated['avatar'] = 'images/avatars/' . $avatar_name;
        }

        // Check the request is same or not
        if ($request->name == $user->name && $request->phone == $user->phone && $request->address == $user->address) {
            if (!$request->has('avatar')) {
                return back()->withErrors([
                    'message' => 'No changes were made.'
                ]);
            }
        }

        // Update the user
        if ($user->update($validated)) {
            return back()->with('success', 'Profile updated successfully.');
        }
    }
}