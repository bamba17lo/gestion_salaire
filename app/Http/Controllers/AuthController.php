<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(AuthRequest $request)
    {
        
        $dataForm = $request->only(['email','password']);
        
        if (Auth::attempt($dataForm)) {
            return redirect()->route('dashboard');
        }else{
            return back()->with('error','Parametre de connexion non reconuue');
        }
    }
}
