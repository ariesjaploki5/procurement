<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $primaryKey = 'app_id';
    public $timestamps = false;

    protected $fillable = [
        'app_year', 'app_budget', 'category_id'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'category_id');
    }
}
