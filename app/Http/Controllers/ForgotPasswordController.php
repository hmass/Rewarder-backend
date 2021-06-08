<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(ForgotPasswordRequest $request){
        $email = $request->input('email');

        //check if user exist
        if(User::where('email', $email)->doesntExist()){
            return response(['message'=>'User does not exist'], 404);
        }

        //generate random token
        $token = Str::random(20);

        try{
            //store the token
            DB::table('password_resets')->insert(['email'=>$email, 'token'=>$token]);

            //send email
            Mail::send('Mails.forgotpassword', ['token' => $token], function(Message $message) use($email){
                $message->to($email);
                $message->subject('Reset your password');
            });

            return response(['message'=>'Check your email'], 200);

        }catch(\Exception $exception){
            return response(['message'=>$exception->getMessage()], 400);
        }
        
    }


    //api method to reset the password
    public function reset(ResetRequest $request){

        /** @var User $user */
        //extract token
        $token = $request->input('token');

        //compare with the token stored
        if(!$passwordReset = DB::table('password_resets')->where('token', $token)->first()){
            return response(['message'=>'Invalid token'], 400);
        }

        //check if user with token email exist
        if(!$user = User::where('email', $passwordReset->email)->first()){
            return response(['message'=>'User does not exist'], 404);
        }

        //hash the new password and save
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response(['message'=>'Password updated successfully'], 200);

    }
}
