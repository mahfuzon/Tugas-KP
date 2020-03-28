<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
    protected $table = "peserta";

    public function pengguna()
    {
    	return $this->belongsTo('User');
    }
}
