<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $table="teachers";
    protected $fillable=['level','nama','email','password','about_urself','picture'];
    public $timestamps=false;
}
