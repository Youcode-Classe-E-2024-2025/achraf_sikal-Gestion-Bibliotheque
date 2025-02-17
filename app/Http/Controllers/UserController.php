<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect("/");
    }
    public function signup(Request $request){
        if($request->method()=="POST"){
            $incomingFildes = $request->validate([
                'name'=> ['required','min:3','max:25',Rule::unique('users','name')],
                'email'=> ['required','email',Rule::unique('users','email')],
                'password'=> ['required','min:8','max:200'],
            ]);
            $incomingFildes['password'] = bcrypt($incomingFildes['password']);
            $user = User::create($incomingFildes);
            auth()->login($user);
            return redirect('/');
        }
        return view('user/signup');
    }
    public function login(Request $request){
        if($request->method()=="POST"){
            $incomingFildes = $request->validate([
                'email'=> ['required'],
                'password'=> ['required'],
            ]);
            if(auth()->attempt($incomingFildes)){
                $request->session()->regenerate();
                return redirect('/');
            }
        }
        return view('user/login');
    }
    public function profile(){
        return view('user/profile');
    }
}
