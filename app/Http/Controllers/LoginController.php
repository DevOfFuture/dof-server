<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;


class LoginController extends Controller
{

    /**
     *  Authenticate the user with credentials
     *  @return JSON Object
     *  @param Request $req
     *  @author sdmg15
     */
  
     public function login(Request $req){
        $credentials = [
            "login" => $req->post("email"),
            "password" => $req->post("password")
        ];
        
        $userAuth = Sentinel::authenticate($credentials,true);

        if( $userAuth ){
            $connectedUser = Sentinel::login($userAuth);
            $res = [
                'success'=>true,
                'user'=> $connectedUser
            ];

            return response()->json($res, 200);
        }

        $error = [
            "success"=> false,
            "error"=> "Invalid user name or password"
        ];

        return response()->json($error, 403);

     }

     /** 
      * Register a user to the application
      *  @return JSON Object 
      *  @param Request $req Object
      *  @author sdmg15
      *  @todo Create a Helper class for request responses handling
      */
    public function register(Request $req){

        $validator = $req->validate([
            'username' => "required|unique:users|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
        ]);

        $credentials = [
            "username" => $req->post("username"),
            "email" => $req->post("email"),
            "password" => $req->post("password")
        ];
        
        if( $errors->any()){
            $error = [
                'success'=> false,
                'error'=>$errors->all()
            ];
            
            return response()->json($error, 403);
        }
        /* @TODO : Set activation to false and send an email for verification */
        /* Redirect to /dashboard after success */

        $user = Sentinel::register($credentials, true);

        if( $user ){
            $res = [
                'success'=> true,
                'user' => $user
            ];

            return response()->json($res, 201);
        }

        $error = [
            'success' => false,
            'error' => 'Sorry something went wrong please try again later',
        ];

        return response()->json($error, 500);
    }

    /**
     *  Logout the user from the application
     */
    public function logout(Request $req){
        if( Sentinel::logout() ){
            $res = ['success' => true];

            return response()->json($res, 200);
        }

        $error = [
            'success' => false,
            'error' => 'Sorry something went wrong please try again later',
        ];

        return response()->json($error, 500);
    }
}
