<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        'password' =>'required|min:6|confirmed'
            ]);
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
            $token = JWTAuth::fromUser($user);
            
            return response()->json([
                'user'=>$user,
                'token'=>$token
            ],201);
    }        
}
