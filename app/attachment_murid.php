<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attachment_murid extends Model
{
    protected $table="attachment_murid";
    protected $fillable=['id_topik','nama_file','tgl_submit'];
    public $timestamps = false;
}
