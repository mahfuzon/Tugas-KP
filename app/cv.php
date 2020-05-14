<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table = 'cv';
    protected $fillable = ['cv', 'lampiran_id'];

    public function lampiran()
    {
        return $this->belongsTo('App\lampiran');
    }
}
