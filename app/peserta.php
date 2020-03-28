<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
    protected $table = "peserta";
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id','lampiran_id',''];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function lampiran(){
        return $this->belongsTo('App\lampiran','lampiran_id');
    }
}
