<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin(Request $request){
        return view("auth.login");
    }
    public function login(LoginRequest $request){
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        $user = User::where("email", $email)->first();
        if($user && Hash::check($password, $user->password)){
            Auth::login($user,$remember);
            return redirect()->route("admin.index");
            
        }else{
            return redirect()
            ->withErrors([
                "email"=> "Verdiğiniz bilgiler hatalı !!"
            ])
            ->onlyInput("email","remember");
        }
    }

    public function logout(Request $request){
        if(Auth::check()){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route("login");
        }
    }
}
