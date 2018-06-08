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
<<<<<<< HEAD
         
=======

>>>>>>> afaad4050c27eec57c57f6b4e8d60af70748c382
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
<<<<<<< HEAD
            return response()->json($res);
=======

            return response()->json($res, 200);
>>>>>>> afaad4050c27eec57c57f6b4e8d60af70748c382
        }

        $error = [
            "success"=> false,
            "error"=> "Invalid user name or password"
        ];
<<<<<<< HEAD
        return response()->json($error);
=======

        return response()->json($error, 403);
>>>>>>> afaad4050c27eec57c57f6b4e8d60af70748c382

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
<<<<<<< HEAD
            return response()->json($error);
=======
            
            return response()->json($error, 403);
>>>>>>> afaad4050c27eec57c57f6b4e8d60af70748c382
        }
        /* @TODO : Set activation to false and send an email for verification */
        /* Redirect to /dashboard after success */

        $user = Sentinel::register($credentials, true);

        if( $user ){
            $res = [
                'success'=> true,
                'user' => $user
            ];
<<<<<<< HEAD
            return response()->json($res);
=======

            return response()->json($res, 201);
>>>>>>> afaad4050c27eec57c57f6b4e8d60af70748c382
        }

        $error = [
            'success' => false,
            'error' => 'Sorry something went wrong please try again later',
        ];

<<<<<<< HEAD
        return response()->json($error);
      
=======
        return response()->json($error, 500);
>>>>>>> afaad4050c27eec57c57f6b4e8d60af70748c382
    }

    /**
     *  Logout the user from the application
     */
    public function logout(Request $req){
        if( Sentinel::logout() ){
<<<<<<< HEAD
            $res = [
                'success' => true,
            ];
            return response()->json($res);
        }
            $error = [
                'success' => false,
                'error' => 'Sorry something went wrong please try again later',
            ];
            return response()->json($error);
=======
            $res = ['success' => true];

            return response()->json($res, 200);
        }

        $error = [
            'success' => false,
            'error' => 'Sorry something went wrong please try again later',
        ];

        return response()->json($error, 500);
>>>>>>> afaad4050c27eec57c57f6b4e8d60af70748c382
    }
}
