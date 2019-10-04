<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function practice()
    {
        return $this->belongsTo('App\Practice');
    }
}
