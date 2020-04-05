<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lampiran extends Model
{
    protected $table = 'lampiran';
    protected $fillable = ['nama','email','mulai','selesai', 'asal_sekolah', 'cv', 'acc'];

    protected $dates = ['mulai', 'selesai'];

    public function peserta(){
        return $this->hasMany('App\peserta', 'lampiran_id');
    }

    public function sekolah(){
        return $this->hasMany('App\sekolah', 'sekolah_id');
    }

    public function cv(){
        return $this->hasOne('App\cv', 'lampiran_id');
    }
    
}
