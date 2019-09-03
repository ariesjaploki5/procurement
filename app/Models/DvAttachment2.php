<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DvAttachment2 extends Model
{
    protected $table = 'dv_attachment';
    public $timestamps = false;

    protected $fillable = [
        'dv_id', 'attachment'
    ];    
}
