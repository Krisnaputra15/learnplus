<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_murid extends Model
{
    protected $table = "data_murid";
    protected $fillable = ['id_kelas','id_murid'];
    public $timestamps = false;
}
