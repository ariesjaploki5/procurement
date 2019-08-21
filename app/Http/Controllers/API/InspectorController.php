<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class InspectorController extends Controller
{
    public function index(){

        $data = DB::table('procurement.dbo.inspector_receiver')->orderBy('name', 'asc')->get();

        return response()->json($data);

    }
}
