<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function fieldsOfPractice()
    {
        return $this->belongsToMany('App\FieldsOfPractice');        
    }
}
