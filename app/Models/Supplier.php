<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'supplier_id';
    public $timestamps = false;

    protected $fillable = [
        'supplier_name', 'supplier_address', 'tel_no', 'zip_code', 
        'tin', 'tax_registration', 'income_tax',
        'business_form', 'created+_at'
    ];
}
