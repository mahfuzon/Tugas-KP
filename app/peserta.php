<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
    protected $table = "peserta";
    protected $fillable = ['user_id','sekolah_id', 'lampiran_id'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function lampiran(){
        return $this->belongsTo('App\lampiran','lampiran_id');
    }

    public function sekolah()
    {
    	return $this->belongsTo('App\sekolah', 'sekolah_id');
    }
}
