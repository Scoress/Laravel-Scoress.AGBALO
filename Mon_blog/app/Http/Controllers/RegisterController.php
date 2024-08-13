<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
 

class RegisterController extends Controller
{
    public function register(){
        return view ('register');
    }
    public function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',
         ]);
        //  if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        //     }

        $user = new User();
 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
 
        $user->save();
 
        return back()->with('success', 'Register successfully');
    }
    
    // public function registerPost(Request  $request)
    // {
    //     dd('bonjour');
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:50',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     $user = new User();
    //        $user->name = $request->name;
    //        $user->email = $request->email,
    //        $user->password = Hash::make($request->password),    
    //     ]);
    //     $user->save();
        

    //     return back()->with('success', 'Register successfully');

    // }

    public function login()
    {
        return view('login');
    }
 
    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'Login Success');
        }
 
        return back()->with('error', 'Error Email or Password');
    }
 
    public function logout()
    {
        Auth::logout();
 
        return redirect()->route('login');
    }
}
