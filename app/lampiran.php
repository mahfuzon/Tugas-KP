<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lampiran extends Model
{
    protected $table = 'lampiran';
    protected $fillable = ['nama_peserta','email_peserta','mulai','selesai', 'asal_sekolah', 'acc'];

    protected $dates = ['mulai', 'selesai'];

    public function peserta(){
        return $this->hasOne('App\peserta', 'lampiran_id');
    }

    public function sekolah(){
        return $this->hasMany('App\sekolah', 'sekolah_id');
    }
    
    public function cv()
    {
        return $this->hasOne('App\Cv');
    }
}
