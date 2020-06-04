<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
    protected $table = "peserta";
    protected $fillable = ['lampiran_id', 'sekolah_id', 'nama_peserta', 'asal_sekolah', 'email_peserta', 'mulai', 'selesai'];

    public function lampiran(){
        return $this->belongsTo('App\lampiran','lampiran_id');
    }

    public function sekolah(){
        return $this->belongsTo('App\sekolah','sekolah_id');
    }
}
