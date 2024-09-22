<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function showLoginForm(){
        return view('login');
    }
    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        
        if(Auth::attempt($infologin)){

            $request->session()->regenerate();
            
            $user = Auth::user();

            if($user->role === 'admin'){
                return redirect()->intended('admin')->with('success', 'Login Success');
            }else{
                return redirect()->intended('home')->with('success', 'Login Success');
            }
        }else{
            return redirect()->back()->withErrors('Username dan Password yang dimasukkan tidak sesuai');
        }
    }
    public function index(){
        return view('home');
    }
    public function logout(){
        Auth::logout();
        return redirect('login'); // Arahkan ke halaman login setelah logout
    }
}