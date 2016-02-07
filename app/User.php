<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

	function hasemail($email){
		
		$user = $this->where("email", $email)->first();
		
		if(isset($user)){
			
			return true;
			
		}
		
		return false;
		
	}
	
    function generateCode()
    {
        $this->code = str_random(4);
    }

    function generateUrl()
    {
        $this->url = str_replace(" ", "-", strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $this->name)));
		
    }

    function generatePasscode()
    {
        $this->passcode = str_random(20);
        // TODO: Check if str_random() is secure enough
    }
}
