<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Validator;

class AdminController extends Controller
{

    //login function with validator on the admin input
    //return the created token
    public function Adminlogin(Request $request){

    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Please fill all fields'], 401);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['message' => 'Incorrect email or pasword'], 401);
        }
        
        return $this->respondWithToken($token);
    }

    //logout function to delete the token and logout from the system
    //return logout message
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'admin successfully signed out']);
    }

    //function to return the admin info with the created token
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'admin'=>auth()->admin()
        ]);
    }

}
