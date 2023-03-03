<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Certificates;
use Validator;

class AdminController extends Controller
{
    //getUsers function to get all the users
    //return the users information
    public function getUsers() {

       $users= user::all()->sortBy('name');

       return response()->json([
          "status" => "Success",
          "data" => $users
       ]);
    }

     //addCertificate function to add a certificate
    //return the certificate information
    public function approveUser(Request $request) {

        $id=$request->id;
        $user = user::find($id);
        $user->status = 1;

        if($user->save()){
           return response()->json([
             "status" => "Success",
             "message" => "User Approved"
           ]);
        }

       return response()->json([
          "status" => "Error",
          "data" => "Error editing profile"
        ]);
     }

    //addCertificate function to add a certificate
    //return the certificate information
    public function addCertificate(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|',
        ]);
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json($validator->errors(), 401);
        }
        $certificate = Certificates::create($validator->validated());
                    
        return response()->json([
            'message' => 'Certrificate successfully added',
            'certificate' => $certificate
        ], 201);
     }


}
