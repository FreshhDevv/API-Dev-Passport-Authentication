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

   }

   //PROFILE METHOD -GET
   public function profile() {

   }

   //LOGOUT METHOD -GET
   public function logout() {
       
   }
}
