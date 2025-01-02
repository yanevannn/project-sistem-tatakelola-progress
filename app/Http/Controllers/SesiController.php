<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('login');
    }


    public function doLogin(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib diiisi',
            'password.required'=>'password wajib diiisi'
        ]);

        $infoLogin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infoLogin)){
            if (Auth::user()->role == 'PengurusInti') {
               return redirect('/dashboard');
            }
                return redirect('/dashboard');
        }else{
            return redirect('/login')->withErrors('Email dan Password tidak sesuai !')->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
