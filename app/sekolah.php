<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sekolah extends Model
{
    protected $table = 'sekolah';
    protected $primaryKey = 'user_id';
    protected $fillable = ['nama_sekolah', 'nama_guru','alamat_sekolah', 'email_guru', 'no_telepon_sekolah', 'user_id'];

    public function peserta(){
        return $this->hasMany('App\peserta', 'sekolah_id');
    }

    public function user(){
        return $this->belongsTo('App\sekolah', 'user_id');
    }
}
