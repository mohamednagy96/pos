<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    
    public function redirect($service){
        return Socialite::driver($service)->redirect();

    }

    public function callback($service){
        $user= Socialite::driver($service)->stateless()->user();
        $existUser=User::whereEmail($user->getEmail())->first();
        if($existUser){
            auth()->login($existUser);
            return redirect()->route('home');
        }else{
            $fullname= explode(' ', $user->getName());
            $existUser=User::create([
                'first_name'=>$fullname[0],
                'last_name'=>$fullname[1],
                'email'=>$user->getEmail(),
                'password'=>bcrypt('user123'),
                ]);
                auth()->login($existUser);
                return redirect()->route('home');
        }
    }
}
