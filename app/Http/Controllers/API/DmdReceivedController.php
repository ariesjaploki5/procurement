<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DmdReceived;
use App\Models\Hdmhdrsub;

class DmdReceivedController extends Controller
{
    public function index(){


    }

    public function store(Request $request){

        $dmd = DmdReceived::create([
            'dmd_id' => $request->dmd_id,
            'purchase_request_id' => $request->purchase_request_id,
            'purchase_order_id' => $request->purchase_order_id,
            'received_quantity' => $request->received_quantity,
            'received_exp' => $request->received_exp,
            'received_type_id' => $request->received_type_id,
            'dmd_po_id' => $request->dmd_po_id,
        ]);
        
        // $mmo_stock = Hdmhdrsub::updateOrCreate([
        //     'dmdcomb' => $request->dmdcomb, 
        //     'dmdctr' => $request->dmdctr, 
        //     'dmhdrsub' => 'DRUM4',
        //     'statusMed' => 'A', 
        // ]);

        // $mmo_stock->stockbal = $mmo_stock->stockbal + $request->received_quantity;
        // $mmo_stock->save();

        return response()->json($dmd);
    }

    public function update(Request $request, $id){
        

    }

    public function destroy($id){


    }
}
