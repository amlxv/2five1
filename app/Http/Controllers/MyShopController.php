<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MyShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);

        // Check if the user not a seller
        if ($user->type != 'both') {
            return redirect('/become-seller')->withErrors(
                [
                    'message' => 'Please apply to become a seller first.'
                ]
            );
        }

        return view('settings.my-shop', compact('user'));
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
            'shop_avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->has('shop_avatar')) {
            $avatar = $request->file('shop_avatar');
            $avatar_name =  $id . time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images/avatars'), $avatar_name);
            $validated['shop_avatar'] = 'images/avatars/' . $avatar_name;
        }

        // Check the request is same or not
        if ($request->shop_name == $user->shop_name) {
            if (!$request->has('avatar')) {
                return back()->withErrors([
                    'message' => 'No changes were made.'
                ]);
            }
        }

        // Update the user
        if ($user->update($validated)) {
            return back()->with('success', 'Your shop details have been updated.');
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