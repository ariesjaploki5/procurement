<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IarBatchController extends Controller
{
    
    public function index(){

    }

    public function show($id){
        $data = DB::table("procurement.dbo.fn_filter_iar($id)")->get();

        return response()->json($data);
    }

}
