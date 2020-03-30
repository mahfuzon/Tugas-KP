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
    
}
