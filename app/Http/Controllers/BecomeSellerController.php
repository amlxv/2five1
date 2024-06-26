<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BecomeSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);

        // Check if the user already a seller
        if ($user->type == 'both') {
            return redirect('/shop')->withErrors([
                'message' => 'You are already a seller.'
            ]);
        }

        return view('settings.become-seller', compact('user'));
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
    public function store(Request $request)
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
        //
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
            'shop_name' => 'required|string|max:255',
            'shop_avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->has('shop_avatar')) {
            $avatar = $request->file('shop_avatar');
            $avatar_name =  $id . time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images/avatars'), $avatar_name);
            $validated['shop_avatar'] = 'images/avatars/' . $avatar_name;
        }

        // Change the user type from user to both user and seller
        $validated['type'] = 'both';

        // Update the user
        if ($user->update($validated)) {
            return redirect('/shop')->with('success', 'Your shop has been created.');
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