<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class DmdPrDmdPo extends Model
{
    protected $table = 'procurement.dbo.view_dmd_pr_dmd_po';
    public $timestamps = false;

    public function last_status(){
        return $this->hasOne("App\Models\PurchaseRequestStatus", 'pr_id', 'pr_id')
        ->orderBY('id', 'desc');
    }

    public function current_last_status(){
        return $this->hasOne("App\Views\PrCurrentStatus", 'pr_id', 'pr_id')
        ->orderBy('current_status_id', 'desc');
    }

    public function last_po_status(){
        return $this->hasOne("App\Models\PurchaseOrderStatus", 'po_id', 'po_id')
        ->orderBy('id', 'desc');
    }
}
