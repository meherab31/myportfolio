<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.dashboard');
    }

    public function getLogin(){
        return view('backend.auth.login');
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            // Check if the logged-in user is an admin
            if(Auth::user()->is_admin){
                return redirect()->route('admin.dashboard')->with('success','Succesfully Logged In');
            }
            else{
                Auth::logout();
                return redirect()->route('admin.login')->with('error','Credential is not matching');
            }
        }

        return back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function Logout(){
        Auth::logout();
        return redirect()->route('home')->with('success','');
    }
}
