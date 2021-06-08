<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function login(LoginRequest $request){

        try{
            if(Auth::attempt($request->only('email', 'password'))){
                /**@var User $user */
                $user = Auth::user();
                
                $token = $user->createToken('app')->accessToken;
    
                return response(['message'=>'Success', 'token'=>$token, 'user'=>$user], 200);
    
    
            }
        }catch(\Exception $exception){
            return response(['message'=>$exception->getMessage()], 400);
        }
        

        return response(['message'=>'Invalid email/password'], 401);
    }

    //get user details
    public function user(){
        return Auth::user();
    }

    public function register(RegisterRequest $request){

        try{
            
            $input = $request->all();

            $input['password'] = Hash::make($input['password']);

            $user = User::create($input);

            return response(['message'=>'User Created Successfully'], 200);
        }catch(\Exception $exception){
            return response(['message'=>$exception->getMessage()], 400);
        }
 

    }
}
