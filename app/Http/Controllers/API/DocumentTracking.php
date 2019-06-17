<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use Carbon\Carbon;

class DocumentTracking extends Controller
{
    public function get_date(){

        return Carbon::now();
    }

    public function div_head_rcv($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'div_head_rcv' => $this->get_date(),
        ]);

        return response()->json($id);
    }

    public function div_head_rls($id){
        
        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'div_head_rls' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function pmo_rcv($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'pmo_rcv' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function pmo_rls($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'pmo_rls' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function div_head_rcv_2($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'div_head_rcv_2' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function div_head_rls_2($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'div_head_rls_2' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function pmo_rcv_2($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'pmo_rcv_2' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function pmo_rls_2($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'pmo_rls_2' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function budget_rcv($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'budget_rcv' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function budget_rls($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'budget_rls' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function accounting_rcv($id){

        $pr = Purchase_request::findOrFail($id); 
        
        $pr->update([
            'accounting_rcv' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function accounting_rls($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'accounting_rls' => $this->get_date(),
        ]);

        return response()->json($id);

    }

    public function mcc_rcv($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'mcc_rcv' => $this->get_date(),
        ]);

        return response()->json($id);
    }

    public function mcc_rls($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'mcc_rls' => $this->get_date(),
        ]);

        return response()->json($id);
    }

    public function fmo_rcv($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'fmo_rcv' => $this->get_date(),
        ]);

        return response()->json($id);
    }

    public function fmo_rls($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'fmo_rls' => $this->get_date(),
        ]);

        return response()->json($id);
    }

    public function pmo_rcv_3($id){
         
        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'pmo_rcv_3' => $this->get_date(),
        ]);

        return response()->json($id);
    }

    public function pmo_rls_3($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'pmo_rls_3' => $this->get_date(),
        ]);

        return response()->json($id);
    }

    public function mmo_rcv($id){

        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'mmo_rcv' => $this->get_date(),
        ]);

        return response()->json($id);
    }

    public function mmo_rls($id){
        
        $pr = Purchase_request::findOrFail($id);
        $pr->update([
            'mmo_rls' => $this->get_date(),
        ]);

        return response()->json($id);
    }
}
