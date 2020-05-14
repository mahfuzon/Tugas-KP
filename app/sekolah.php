<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sekolah extends Model
{
    protected $table = 'sekolah';
    protected $primaryKey = 'user_id';
    protected $fillable = ['nama_sekolah', 'guru_pembimbing','alamat', 'email_guru', 'hp_guru', 'user_id'];

    public function peserta(){
        return $this->hasMany('App\peserta', 'sekolah_id');
    }

    public function user(){
        return $this->belongsTo('App\sekolah', 'user_id');
    }
}
