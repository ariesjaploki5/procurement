<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class DmdPrDmdPo extends Model
{
    protected $table = 'procurement.dbo.view_dmd_pr_dmd_po';
    public $timestamps = false;

    public function last_status(){
        return $this->hasOne("App\Models\PurchaseRequestStatus", 'purchase_request_id', 'purchase_request_id')
        ->orderBY('id', 'desc');
    }

    public function current_last_status(){
        return $this->hasOne("App\Views\PrCurrentStatus", 'purchase_request_id', 'purchase_request_id')
        ->orderBy('current_status_id', 'desc');
    }
}
