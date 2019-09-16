<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Iar;
use App\Models\IarBatch;

class IarBatchController extends Controller
{
    
    public function index(){

    }

    public function show($id){
    
        $data = DB::table("procurement.dbo.fn_filter_iar()")->where('po_id', $id)->get();

        return response()->json($data);

    }

    public function show_2($id){

        $data = DB::table("procurement.dbo.fn_filter_iar()")->where('iar_no', $id)->get();

        return response()->json($data);

    }

    public function show_3($id){

        $data = Iar::with([
            'iar_batches'
        ])->where('iar_no', $id)->first();
        
        return response()->json($data);
        
    }

    public function show_4($id){

        $data = DB::table("procurement.dbo.fn_get_all_iar()")->where('iar_no', $id)->first();

        return response()->json($data);

    }

}
