<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
    protected $table = "peserta";
    protected $primaryKey = 'lampiran_id';
    protected $fillable = ['sekolah_id', 'lampiran_id'];

    public function user()
    {
    	return $this->hasOne('App\User', 'lampiran_id');
    }

    public function lampiran(){
        return $this->belongsTo('App\lampiran','lampiran_id');
    }

    public function sekolah()
    {
    	return $this->belongsTo('App\sekolah', 'sekolah_id');
    }
}
