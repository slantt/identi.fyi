<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\social;

use App\SocialLink;

class UserController extends Controller
{
	
    public function showProfile($name, $code)
    {
		
		$userFound = User::where("url", $name)->where("code", $code)->firstOrFail();
		$socialView = SocialLink::generateView($name);
        return view('profile.show')->with('user', $userFound)->with('socialView', $socialView);
    }

    public function edit($id, $passcode)
    {
        $userFound = User::where('id', $id)->firstOrFail();
        if($userFound->passcode != $passcode) {
            return view('errors.custom')->with('text', "This link has expired. Check your inbox for a new email, or try sending it again.");
        }
		$socialForm = SocialLink::generateForm($id);
        return view('profile.edit')->with('user', $userFound)->with('socialForm', $socialForm);
    }
	
	public function signup(Request $request)
    {
        
		$user = new User;
		
		$user->email = $request->input("email");
		$user->generatePasscode();
		$user->generateCode();
		
		$user->save();
		
		return redirect()->action("UserController@edit", [$user->id, $user->passcode]);
		
	}
	
	public function updateinfo(Request $request, $id, $key){
		
		$user = User::where('id', $id)->firstOrFail();
		
		$name = $request->input('name');
		$city = $request->input('city');
		$bio = $request->input('bio');
		$job = $request->input('job');
		$phone = $request->input('phone');
		$website = $request->input('website');

		$media = $request->input('social');
		
		SocialLink::savemedia($id, $media);
		
		$user->name=$name;
		$user->bio=$bio;
		$user->city=$city;
		$user->job=$job;
		$user->phone=$phone;
		$user->website=$website;
		
		$user->generateUrl();
		$user->save();
		
		return redirect()->action("UserController@showProfile", [$user->url, $user->code]);
		
	}
	
}
