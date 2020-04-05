<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cv extends Model
{
    protected $table = "cv";
    protected $primaryKey = 'lampiran_id';
    protected $fillable = ['cv', 'lampiran_id'];

    public function lampiran()
    {
    	return $this->belongsTo('App\lampiran', 'lampiran_id');
    }

}
