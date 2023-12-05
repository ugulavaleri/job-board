<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email','password']);

        if(Auth::attempt($credentials)){
            return redirect('/');
        }else{
            return redirect()->back()->with(['error' => 'Invalid Credentials']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        \request()->session()->invalidate();
        \request()->session()->regenerateToken();

        return redirect('/');
    }
}
//$request->validate([
//    'email' => 'required|email',
//    'password' => 'required'
//]);
//
//$credentials = $request->only(['email', 'password']);
//$remembered = $request->filled('remember');
//
//if(Auth::attempt($credentials,$remembered)){
//    return redirect('/');
//}else{
//    return redirect()->back()->with(['error' => 'Invalid Credentials']);
//}
