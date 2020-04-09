<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sekolah extends Model
{
    protected $table = 'sekolah';
    protected $fillable = ['nama_sekolah' , 'alamat_sekolah', 'email_sekolah', 'no_telepon_sekolah'];

    public function peserta(){
        return $this->hasMany('App\peserta', 'sekolah_id');
    }
}
