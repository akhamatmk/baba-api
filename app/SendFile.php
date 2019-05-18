<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SendFile extends Model
{
	public function getNoteAttribute($value)
    {
    	if($value == 0)
    		return false;
    	else
    		return true;
    }

    public function getImageAttribute($value)
    {
    	return url('images/'.$value);
    }
}
