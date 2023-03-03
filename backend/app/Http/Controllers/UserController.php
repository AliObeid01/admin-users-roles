<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class UserController extends Controller
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
            return response()->json($validator->errors(), 401);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)],
                ));
        return response()->json([
            'message' => 'User successfully registered',
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

    //updateProfile Function to update user profile
    //return update message
    public function updateProfile(Request $request) {
        $id = Auth::id();
        $user = user::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->blood_type = $request->blood_type;

        if($user->save()){
            return response()->json([
                "status" => "Success",
                "message" => "Profile updated"
            ]);
        }

        return response()->json([
            "status" => "Error",
            "data" => "Error editing profile"
        ]);

    }

    //attachCertificate Function to let user attach a certificate to his profile
    //return Success message
    public function attachCertificate(Request $request) {
        $id = Auth::id();
        $user = user::find($id);
        $user->userCertificates()->attach($request->certificate_id);

        return response()->json([
            "status" => "Success",
            "message" => "certificate has been added to your profile"
        ]);

    }

    //removeCertificate Function to let user remove a certificate from his profile
    //return Success message
    public function removeCertificate(Request $request) {
        $id = Auth::id();
        $user = user::find($id);
        $user->userCertificates()->detach($request->certificate_id);

        return response()->json([
            "status" => "Success",
            "data" => "certificate has been removed from your profile"
        ]);
    }

    //getCertificates Function to get the Certificates of the user
    public function getCertificates(Request $request) {
        $id = Auth::id();
        $user = user::find($id);
        return $user->userCertificates()->get();
    }

    //logout function to delete the token and logout from the system
    //return logout message
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }


}