<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    //register function with validator on the input user
    //return the user information
    public function register(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|',
            'gender' => 'required|string|',
            'blood_type' => 'required|string|',
        ]);
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json(['message'=> $validator->errors()],401);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)],
                ));
        return response()->json([
            'message' => 'Successfully registered.Please wait until the admin approved you.',
            'user' => $user
        ], 201);
    }

    //login function with validator on the user input
    //return the created token
    public function login(Request $request){

    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Please fill all fields'], 401);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['message' => 'Incorrect email or password'], 401);
        }
        if(auth()->User()->status!=1){
            return response()->json(['message' => 'You are not approved yet by the admin'], 401);
        }
        
        return $this->respondWithToken($token);
    }

    //function to return the user info with the created token
    protected function respondWithToken($token){

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user'=>auth()->User()
        ]);
    }

    //notFound Function to route the user when unauthorized
    function notFound(){
        return response()->json([
            "status" => "Error",
            "message" => "You are not Authorized"
        ]);
    }
}
