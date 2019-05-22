<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $primaryKey = 'transfer_id';
    public $timestamps = false;

    protected $fillable = [
        'transfer_sender', 'transfer_receiver', 'transfer_value'
    ];
}
