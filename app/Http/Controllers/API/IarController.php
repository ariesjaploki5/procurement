<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IarController extends Controller
{
    public function index(){
        $data = DB::table("procurement.dbo.fn_get_all_iar()")->get();

        return response()->json($data);
    }


}
