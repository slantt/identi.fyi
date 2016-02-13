<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Input as Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Social;

use Mail;

class UserController extends Controller
{

    public function show($name, $code)
    {

		$user = User::where("url", $name)->where("code", $code)->firstOrFail();
        return view('profile.show')->with('user', $user);
    }

    public function edit($id, $passcode)
    {
        $user = User::find($id);

        if($user->passcode != $passcode) {
            return view('errors.custom')->with('text', "This link has expired.");
        }

        return view('profile.edit')->with('user', $user);
    }

	public function create(Request $request)
    {

		$user = new User;

		$user->email = $request->input("email");

        Mail::send("emails.signup", [],
            function ($m) use ($user){
                $m->from('hello@example.com', 'Identifyi');
                $m->to($user->email)->subject("Welcome to Identifyi");
            }
        );

		$user->generatePasscode();
		$user->generateCode();

		$user->save();

		return redirect()->action("UserController@edit", [$user->id, $user->passcode]);

	}

	public function store(Request $request, $id, $passcode){

		$user = User::find($id);

		if($user->passcode != $passcode) {
			return view('errors.custom')->with('text', "This link has expired.");
		}

		$linksTitles = $request->input('social_title');
		$links = $request->input('social');
		
        $user->socials()->delete();

		for($i=0;$i<sizeof($links);$i++){
			
			if($links[$i]!=""&&$linksTitles[$i]!=""){
			
				$newLink = new Social;
				$newLink->verifyLink($links[$i]);
				$newLink->title=$linksTitles[$i];
				$user->socials()->save($newLink);
			
			}
			
		}

		$user->name = $request->input('name');
		$user->bio = $request->input('bio');
		$user->city = $request->input('city');
		$user->job = $request->input('job');
		$user->phone = $request->input('phone');
		$user->website = $request->input('website');;
		$user->experience = $request->input('experience');
		
		$user->generateUrl();

		// Beginning (Profile) Image Work -->
		
		
		if($request->hasFile('profileImage')){
			
			$file = $request->file('profileImage');
			
			// Delete all present files by this user
			
			$files = glob("ProfileImages/".$user->code.".*");
				
			foreach ($files as $File) {
				
				unlink($File);
			
			}
			
			$fileName = $user->code.".".$file->getClientOriginalExtension();
			$file->move("ProfileImages", $fileName);
			
			$user->img=$fileName;
			
		}
		
		$user->save();
		
		return redirect()->action("UserController@show", [$user->url, $user->code]);
	}

}
