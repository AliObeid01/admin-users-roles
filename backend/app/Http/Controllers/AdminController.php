<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AdminController extends Controller
{

    public function getUsers() {

       $users= user::all()->sortBy('name');

       return response()->json([
          "status" => "Success",
          "data" => $users
       ]);
    }

}
