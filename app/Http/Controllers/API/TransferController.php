<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transfer;

class TransferController extends Controller
{
    public function index(){
                

    }

    public function store(Request $request){

        $transfer = Transfer::create([
            'transfer_sender' => $request->transfer_sender,
            'transfer_receiver' => $request->transfer_receiver,
            'transfer_value' => $request->transfer_value,
            'dmdctr' => $request->dmdctr,
            'dmdcomb' => $request->dmdcomb,
        ]);        

        return response()->json();
    }

    public function show($id){
        $transfer = Transfer::findOrFail($id);

        return response()->json();
    }


    public function update(Request $request, $id){
        
        $transfer = Transfer::findOrFail($id);

        $transfer->update([
            'transfer_sender' => $request->transfer_sender,
            'transfer_receiver' => $request->transfer_receiver,
            'transfer_value' => $request->transfer_value,
            'dmdctr' => $request->dmdctr,
            'dmdcomb' => $request->dmdcomb,
        ]);

        return response()->json();
    }

    public function destory($id){
        
        $transfer = Transfer::where('transfer_id', $id)->first();
        $transfer->delete();

        return response()->json();
    }
}
