<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sekolah extends Model
{
    protected $table = 'sekolah';
    protected $fillable = ['nama' , 'alamat', 'email', 'no_telepon', 'sekolah_id'];

    public function peserta(){
        return $this->hasMany('App\peserta', 'sekolah_id');
    }
}
