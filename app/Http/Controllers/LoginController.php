<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // This method will show login page for customer 
 public function index(){
     return view("account.login");
 }

//  This method will Authenticate the user 
public function authenticate(Request $request){
    $validator = Validator::make($request->all(),[
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if($validator->passes()){
  if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
    //  return redirect('account.dashboard');
  }else{
     return redirect()->route('account.login')->with('error', 'Either email or password is incorrect.');
  }
    } else{
         return redirect()->route('account.login')->withInput()->withErrors($validator);
    }
}

// This method will show register page 
public function register(){
    return view('account.register');
}

// This method will register the users 
public function processRegister(Request $request){
    $validator = Validator::make($request->all(),[
       'email' => 'required|email|unique:users',
       'name' => 'required',
       'password' => 'required|confirmed|min:5',
       'password_confirmation' => 'required',
    ]);

    if($validator->passes()){
//   if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
//     //  return redirect('account.dashboard');
//   }else{
//      return redirect()->route('account.login')->with('error', 'Either email or password is incorrect.');
//   }
    } else{
         return redirect()->route('account.register')->withInput()->withErrors($validator);
    }
}

}
