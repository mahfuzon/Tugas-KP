<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
    protected $table = "peserta";
    protected $fillable = ['lampiran_id', 'sekolah_id'];

    public function lampiran(){
        return $this->belongsTo('App\lampiran','lampiran_id');
    }
}
