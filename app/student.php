<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $table="students";
    protected $fillable=['level','nama','email','password','about_urself'];
    public $timestamps=false;
}
