<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function Verif($token = null)
    {
    

       $user = User::where('verification_token',$token)->first();

       if($user == null ){

       	// session()->flash('message', 'Invalid Login attempt')
           return view('/email/verification-failure');
       }else{
            $user->update([
            
                'email_verified_at' => Carbon::now(),
                'verification_token' => ''
        
            ]);
            return view('/email/verification-success');
       }

     
       
       //	session()->flash('message', 'Your account is activated, you can log in now');

        

    }
}
