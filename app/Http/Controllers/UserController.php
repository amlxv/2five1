<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Response;
use View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /***
         * Check whether the requester is
         * the same as the user being viewed
         * or not.
         */

        // if (Auth::user()->id != $id) {
        //     return View('error.403');
        // }

        // if (!$user = User::find($id)) {
        //     return View('error.404');
        // }

        // return View('profile.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
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
        ]);

        // Check the request is same or not
        if ($request->name == $user->name && $request->phone == $user->phone && $request->address == $user->address) {
            return back()->withErrors([
                'message' => 'No changes were made.'
            ]);
        }

        // Update the user
        if ($user->update($validated)) {
            return back()->with('success', 'Profile updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}