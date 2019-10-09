<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class Practice extends Model
{
    protected $fillable = ['name', 'email', 'logo', 'website'];
    
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function fieldsOfPractice()
    {
        return $this->belongsToMany('App\FieldsOfPractice');        
    }

    public function getLogoAttribute($value)
    {
        // The actual path from which the logo can be accessed publicly can vary (based on config)
        if(NULL !== $value) return Storage::url($value);
    }

    public function setLogoAttribute($value)
    {
        if(NULL === $value) return NULL;

        if(is_string($value)) $this->attributes['logo'] = $value;

        if($value instanceof UploadedFile) {
            $logo = $value->store('logos', ['disk' => 'public']);
            $this->attributes['logo'] = $logo;
        }
    }

    public function getWebsiteAttribute($value)
    {
        if(NULL === $value) return NULL;

        // Prepend 'http://' to the website if it's not set already (http or https). This is to make sure the website URL is treated as an external link when rendered (i.e. avoid having a link like this: https://this-app.com/practice-website.com, but instead: http://practice-website.com)
        return preg_match('^https?\:\/\/^', $value) ? $value : 'http://' . $value;
    }
}
