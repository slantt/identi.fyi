<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
	public function user() {
        return $this->belongsTo('App\User');
    }
	
	public function defineTitle(){
		
		preg_match('/(https:\/\/|http:\/\/)?(www\.)?(.*)/', $this->link, $matches);
		$this->title=$matches[3];
		
	}
	
}
