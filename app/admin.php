<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table="admin";
    protected $fillable=['level','nama','email','password','about_urself'];
    public $timestamps=false;
}
