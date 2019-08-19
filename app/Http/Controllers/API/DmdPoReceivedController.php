<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DmdPoReceived;
use App\Models\DmdUacs;
use DB;

class DmdPoReceivedController extends Controller
{
    
    public function index(){

    }

    public function store(Request $request){
        $dmd_uacs = DB::table('dmd_uacs')->where('dmd_id', $request->dmd_id)->where('brand_id', $request->brand_id)->first();

        return $dmd_uacs;


        $dmd_po_r = DmdPoReceived::create([
            'list_no' => $request->list_no,
            'receiving_officer_id' => $request->officer_id,
            'inspection_officer_id' => $request->inspection_id,
            'received_quantity' => $request->order_quantity,
            'remarks' => $request->remarks,
            'date_received' => $request->date_received,
            'expiry_date' => $request->expiry_date,
        ]);

        $dmd_uacs = DB::table('dmd_uacs')->where('dmd_id', $request->dmd_id)->where('brand_id', $request->brand_id)->firstOrFail();

        return $dmd_uacs;

        $last_quantity = $dmd_uacs->stock_quantity;
        if($last_quantity){
            $new_quantity = $last_quantity + $request->order_quantity;
            
        } else{
            $new_quantity = $request->order_quantity;
        }

        $dmd_uacs->update([
            'stock_quantity' => $new_quantity,
        ]);

        return response()->json();

    }

    public function update(Request $request, $id){

        $dmd_po_r = DmdPoReceived::findOrFail($id);

        $last_received_quantity = $dmd_po_r->received_quantity;

        $dmd_po_r->update([
            'list_no' => $request->list_no,
            'receiving_officer_id' => $request->receiving_officer_id,
            'inspection_officer_id' => $request->inspection_offcier_id,
            'received_quantity' => $request->order_quantity,
            'remarks' => $request->remarks,
            'date_received' => $request->date_received,
            'expiry_date' => $request->expiry_date,
        ]);

        $dmd_uacs = DmdUacs::where('dmd_id', $request->dmd_id)->where('brand_id', $request->brand_id)->firstOrFail();
        $last_quantity = $dmd_uacs->stock_quantity - $last_received_quantity;
        $new_quantity = $last_quantity + $request->order_quantity;

        $dmd_uacs->update([
            'stock_quantity' => $new_quantity,
        ]);

        return response()->json();
    }

    public function show($id){


    }

    public function destroy($id){


    }
}
