<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_topik extends Model
{
    protected $table = "data_topik";
    protected $fillable = ['id_topik','id_murid','status','turn_in_date'];
    public $timestamps = false;
}
