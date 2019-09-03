<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DvAttachment extends Model
{
    protected $table = 'dv_attachments';
    public $timestamps = false;

    protected $fillable = [
        'po_id', 'purchase_order_id', 'attachment_id', 'number_date_particulars'
    ];    
}
