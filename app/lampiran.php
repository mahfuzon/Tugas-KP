<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class lampiran extends Model
{
    protected $table = 'lampiran';
    protected $fillable = ['nama','email','mulai','selesai', 'asal_sekolah', 'acc'];
    
}
