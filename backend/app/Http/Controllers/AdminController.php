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

    //approveUser function to aapprove a user
    //return approved message
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
          "data" => "Error approve user"
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
    //getCertificates function to get Certificates
    //return the list of certificates
    public function getCertificates () {

        $certificates= Certificates::all();

        return response()->json([
           "status" => "Success",
           "data" => $certificates
        ]);
     }
    //certificatesReport function to get Certificates with number of users per certificate
    //return the number of users
    public function certificatesReport (Request $request) {

        $id=$request->id;
        $certificatesReport = Certificates::find($id);
        return $certificatesReport->certificatesPerUser()->get()->count();
     }

}
