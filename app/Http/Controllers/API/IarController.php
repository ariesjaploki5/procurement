<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Iar;

class IarController extends Controller
{
    public function index(){

        $data = DB::table("procurement.dbo.fn_get_all_iar()")->get();
        return response()->json($data);

    }


    public function store(Request $request){
        


        $iar = Iar::create([
            'iar_no' => $request->iar_no,
            'dmd_id' => $request->dmd_id,
            'expiry_date' => $request->expiry_date,
            'received_quantity' => $request->received_quantity,
            'batch_no' => $request->batch_no, 
        ]);

        return response()->json();

    }


    public function update(Request $request, $id){

        $iar = Iar::find($id);
        $iar->update([
            'iar_no' => $request->iar_no,
            'dmd_id' => $request->dmd_id,
            'expiry_date' => $request->expiry_date,
            'received_quantity' => $request->received_quantity,
            'batch_no' => $request->batch_no, 
        ]);

        return response()->json();
    }

    public function show($id){


    }

    public function destroy($id){


    }

    
}
