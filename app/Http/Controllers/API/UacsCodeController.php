<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UacsCode;
use DB;

class UacsCodeController extends Controller
{
    public function index(){
        $data = UacsCode::orderBy('uacs_desc', 'asc')
        ->select('uacs_desc', 'id', 'uacs_code')
        ->get();

        return response()->json($data);
    }

    public function show($id){
        $data = DB::table('procurement.dbo.po_uacs_codes')->where('po_id', $id)->get();

        return response()->json($data);
    }
}
