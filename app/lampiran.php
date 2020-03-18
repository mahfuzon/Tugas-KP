<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lampiran extends Model
{
    protected $table = 'lampiran';
    protected $fillable = ['nama','email','mulai','selesai', 'asal_sekolah'];
}
