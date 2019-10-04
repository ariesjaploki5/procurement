<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PmoController extends Controller
{
    public function index(){

        $data = DB::table("pmo.dbo.fn_all_dmds()")->orderBy('item_desc', 'asc')->get();

        return response()->json($data);
    }
}
