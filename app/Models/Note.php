<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	public function user(){
		return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}

	public function scopeWherePublic($query){
		return $query->where('private', 0);
	}

	public function belongsToCurrentUser(){
		return $this->user_id == Auth::id();
	}
}
