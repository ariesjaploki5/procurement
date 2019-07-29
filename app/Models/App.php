<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\AppCreated;
use App\Events\AppUpdated;

class App extends Model
{
    protected $primaryKey = 'app_id';
    public $timestamps = false;

    protected $fillable = [
        'app_year', 'app_budget', 'category_id'
    ];

    protected $dispatchesEvents = [
        'saved' => AppCreated::class,
        'updated' => AppUpdated::class,
    ];
    
    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'category_id');
    }

    public function dmds(){
        return $this->belongsToMany('App\Models\Dmd', 'app_dmd', 'app_id', 'dmd_id');
    }

    public function app_dmds(){
        return $this->hasMany('App\Models\AppDmd', 'app_id', 'app_id');
    }
}
