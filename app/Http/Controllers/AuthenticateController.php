<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;

class AuthenticateController extends Controller
{
    public function index() {

    }

    /*This authenticates the user by
    *generating the token
    */
    public function authenticate (Request $request){
      $credentials  = $request->only('email','password');
      try{
        //dd($credentials);
        if(!$token = JWTAuth::attempt($credentials)){
          return response()->json(['error'=>'invalid_credentials'],401);
        }
      }
      catch (JWTException $e){
        return response()->json(['error'=>'no token created'],500);
      }

      return response()->json(compact('token'));
    }

    public function logout(Request $request)
    {
        return JWTAuth::invalidate(JWTAuth::getToken());
    }
}
