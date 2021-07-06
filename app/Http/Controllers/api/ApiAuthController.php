<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    //register user
    public function registerUser(Request $request)
    {
        //validate 
        $atter = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        //create user
        $user = User::create([
            'name' => $atter['name'],
            'email' => $atter['email'],
            'password' => Hash::make($atter['password']),
        ]);

        //return token and register user
        return response(
            [
                'user' => $user,
                'token' => $user->createToken('secret')->plainTextToken
            ]
        );
    }


    //login user 
    public function loginUser(Request $request){
        //validate 
        $atter=$request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        //attempt login 
        if(!Auth::attempt($atter)){
            return response([
                'message' =>'invalid email and password'
            ],403); 
        }
        $user=auth()->user();
        return response([
            'user'=>$user,
            'token'=>$user->createToken('secret')->plainTextToken
        ],200);
    }
}
