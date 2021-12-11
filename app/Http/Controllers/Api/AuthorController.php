<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
   // REGISTER METOD -POST
   public function register(Request $request) {
      // validation
      $request->validate([
         'name' => 'required',
         'email' => 'required|email|unique:authors',
         'password' => 'required|confirmed',
         'phone_no' => 'required'
      ]);

      // create data
      $author = new Author();
      //the first name is a colomn in the authors table and the second name is the value we are getting from the body
      $author -> name = $request -> name;
      $author -> email = $request -> email;
      $author -> phone_no = $request -> phone_no;
      $author -> password = bcrypt($request -> password);

      // save data and send response
      $author -> save();

      return response() -> json([
         'status' => 1,
         'message' => 'Author created successfully'
      ]); 

   }

   //LOGIN MEHTOD -POST
   public function login(Request $request) {
      // validation
      $login_data = $request -> validate([
         'email' => 'required',
         'password' => 'required'
      ]);

      //validate author data
      if(!auth()->attempt($login_data)) {
         return response()->json([
            'status' => false,
            'message' => 'Invalid Credentials'
         ], 401);
      }

      //token
      $token = auth()->user()->createToken('auth_token')->accessToken;

      //send response
      return response()->json([
         'status' => true,
         'message' => 'Author logged in successfully',
         'access_token' => $token
      ]);

   }

   //PROFILE METHOD -GET
   public function profile() {
      $user_data = auth()->user();

      return response()->json([
         'status' => true,
         'message' => 'User Data',
         'data' => $user_data
      ]);

   }

   //LOGOUT METHOD -GET
   public function logout() {
       
   }
}
