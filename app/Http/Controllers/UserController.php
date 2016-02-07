<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
	
    public function showProfile($name, $code)
    {
		
		$userFound = User::where("url", $name)->where("code", $code)->firstOrFail();
        return view('profile.show')->with('user', $userFound);
    }

    public function edit($id, $passcode)
    {
        $userFound = User::where('id', $id)->firstOrFail();
        if($userFound->passcode != $passcode) {
            return view('errors.custom')->with('text', "This link has expired. Check your inbox for a new email, or try sending it again.");
        }
        return view('profile.edit')->with('user', $userFound);
        return view('profile.edit')->with('user', $userFound);
    }
	
	public function signup(Request $request)
    {
		
        $email = $request->input('email');
		 
        $user = new User;
		
		if($user->hasemail($email)){
			
			//Do Something
			
		}else{
		
		$user->email=$email;
        $user->generateCode();
		$user->generatePasscode();
        $user->save();
	}
		return redirect()->action("UserController@edit", [$user->id, $user->passcode]);
		
	}
	
	public function updateinfo(Request $request, $id, $key){
		
		$user = User::where('id', $id)->firstOrFail();
		
		$name = $request->input('name');
		$city = $request->input('city');
		$bio = $request->input('bio');
		$linkedin = $request->input('linkedin');
		$facebook = $request->input('facebook');
		$twitter = $request->input('twitter');
		
		$user->name=$name;
		$user->twitter=$twitter;
		$user->facebook=$facebook;
		$user->linkedin=$linkedin;
		$user->bio=$bio;
		$user->city=$city;
		$user->generateURL();
		$user->save();
		
		
		
		return redirect()->action("UserController@showProfile", [$user->url, $user->code]);
		
	}
	
}
