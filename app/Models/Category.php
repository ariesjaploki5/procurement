<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    public $timestamps = false;

    protected $fillable = [
        'category_desc',
    ];

    public function apps(){
        return $this->hasMany('App\Models\App', 'category_id', 'category_id');
    }
}
