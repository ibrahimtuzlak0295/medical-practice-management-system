<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldsOfPractice extends Model
{
    protected $table = 'fields_of_practice';

    public function practices()
    {
        return $this->belongsToMany('App\Practice');
    }
}
