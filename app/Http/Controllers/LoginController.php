<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('Login.login');
    }

    public function get_login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($request->login_type=='Speaker'){
            if (Auth::guard('speakers')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('talk-proposals');
            }
        }
        else{
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('reviewer-dashboard');
            }
        }

        return redirect()->back()->with('message', 'Invalid credentials')->withInput();
    }

    public function speaker_logout(){
        Auth::guard('speakers')->logout();
        return redirect()->route('login');
    }
}
