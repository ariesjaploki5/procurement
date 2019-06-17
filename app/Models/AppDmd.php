<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\AppDmdUpdated;


class AppDmd extends Model
{
    protected $table = 'app_dmd';
    public $timestamps = false;

    protected $dispatchesEvents = [
        'updated' => AppDmdUpdated::class,
    ];

    protected $fillable = [
        'budget', 'mode_id', 'quantity', 'unit_id'
    ];
}
