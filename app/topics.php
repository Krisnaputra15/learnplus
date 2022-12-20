<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topics extends Model
{
    protected $table="topics";
    protected $fillable=['id_kelas','nama_topik','deskripsi','tgl_buat','tgl_deadline'];
    public $timestamps = false;
}
