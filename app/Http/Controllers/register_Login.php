<?php

namespace App\Http\Controllers;

use App\Models\folder_uploads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class register_Login extends Controller
{
    public function index(){
            $totalFolders = folder_uploads::where('user_id', Auth::id())->count();
        return view("/index",compact("totalFolders"));
    }
    public function register(){
        return view("/register");
    }
    public function login(){
        return view("/login");
    }

    public function register_submit(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:8'
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return redirect()->route('login');
    }

    public function login_submit(Request $request){
        $credintals=$request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Auth::attempt($credintals)){
            $request->session()->regenerate();
            return redirect()->route("home");
        }
        return back()->withErrors("Credintals Are Not Match");
    }

    public function logout(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
    }
}
