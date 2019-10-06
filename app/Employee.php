<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable = ['first_name', 'last_name', 'practice_id', 'email', 'phone'];

    public function practice()
    {
        return $this->belongsTo('App\Practice');
    }

    public function getFullNameAttribute()
    {
    	return $this->first_name . ' ' . $this->last_name;
    }
}
