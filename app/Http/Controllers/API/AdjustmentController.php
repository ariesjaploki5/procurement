<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Views\AdjustmentItem;
use App\Models\Item;
use App\Models\Adjustment;
use App\Views\HomisDrugsAndMedicines;
use App\Models\Hdmhdrsub;
use Carbon\Carbon;

class AdjustmentController extends Controller
{
    
    public function items($id){
        $data = AdjustmentItem::where('chrgcode', $id)
        ->orderBy('gendesc', 'asc')
        ->get();

        return response()->json($data);
    }

    public function search(Request $request, $id){
        $data = AdjustmentItem::where('chrgcode', $id)
        ->where('item_desc', 'like', $request->word.'%')
        ->orderBy('gendesc', 'asc')
        ->get();
        
        return response()->json($data);
    }
    
    public function adjust_drugs(Request $request){
        
        $adjust = Adjustment::create([
            'itemType' => 'D',
            'dmdComb' => $request->dmdcomb,
            'dmdCtr' => $request->dmdctr,
            'dmhdrsub' => $request->chrgcode,
            'stockB4Adjust' => $request->stockbal,
            'operation' => $request->operation,
            'transQty' => $request->value,
            'remarks' => $request->remarks,
            'entry' => $request->employee_id,
        ]);

        $this->adjust_stockbal($request);
    }

    public function adjust_stockbal($request){
        $adjust_stockbal = Hdmhdrsub::where('dmdcomb', $request->dmdcomb)
        ->where('dmdctr', $request->dmdctr)
        ->where('dmhdrsub', $request->chrgcode)
        ->first();
        
        return response()->json();
    }

    public function get_medicines(){
        $data = HomisDrugsAndMedicines::orderBy('gendesc', 'asc')->get();

        return response()->json($data);
    }

    public function add_medicine(Request $request, $id){
        $medicine = Hdmhdrsub::create([
            'dmdcomb' => $request->dmdcomb,
            'dmdctr' => $request->dmdctr,
            'dmhdrsub' => $id,
            'stockbal' => 0,
            'statusMed' => 'A',
            'baldteasof' => Carbon::now(),
        ]);

        return response()->jsoN($medicine);
    }
}
