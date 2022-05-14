<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role != 'admin') {
            return abort(403);
        }

        $users = User::all();

        return view('users.index', compact('users'));
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
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->type = $request->type;
        $user->role = $request->role;
        $user->shop_name = $request->shop_name;

        if ($request->has('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_name =  $id . time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images/avatars'), $avatar_name);
            $user->avatar = 'images/avatars/' . $avatar_name;
        }

        if ($request->has('shop_avatar')) {
            $avatar = $request->file('shop_avatar');
            $avatar_name =  $id . time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images/avatars'), $avatar_name);
            $user->shop_avatar = 'images/avatars/' . $avatar_name;
        }

        if ($user->save()) {
            return redirect()->route('users.index')->with('success', 'User updated successfully');
        }

        return back()->withInput()->withErrors([
            'error' => 'Unknown error occurred while trying to update user.'
        ]);
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