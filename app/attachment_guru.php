<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attachment_guru extends Model
{
    protected $table="attachment_guru";
    protected $fillable=['id_topik','nama_file','tgl_submit'];
    public $timestamps = false;
}
