<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    protected $table="classes";
    protected $fillable=['nama_kelas','id_guru','jumlah_murid','picture','class_code'];
    public $timestamps=false;
}
