<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class UserController extends Controller
{

    //userProfile Function return the user information
    public function userProfile() {
        return response()->json(auth()->user());
    }
    
    //updateProfile Function to update user profile
    //return update message
    public function updateProfile(Request $request) {
        $id = Auth::id();
        $user = user::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->email;
        $user->blood_type = $request->blood_type;
        $user->password = bcrypt($request->password);
        

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
        $id = Auth::id();
        $user = user::find($id);
        $user->last_login = date('Y-m-d H:i:s') ;
        $user->save();
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    
}