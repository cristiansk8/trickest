<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register (Request $request){
        $this->validate($request,[
            'name' => 'requiered|max:255',
            'email' =>'required|email|max:255|unique:users',
            'password'=>'required |min:6|confirmed'
        ]);

        $user = User::create ([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> password)
        ]);
        
        return response() -> json([
            'user'=> $user
        ],201);
    }

}



