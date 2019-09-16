<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DmdUacs;
use DB;
use App\Views\Dmd as Dmd_2;

class DmdUacsController extends Controller
{
    public function index(){

        $data = DB::select('select * from fn_dmd_uacs() order by dmddesc asc');

        return response()->json($data);

    }

    public function store(Request $request){
        
        $uacs = DmdUacs::firstOrCreate([
            'dmd_id' => $request->dmd_id,
            'code' => $request->code,
            'brand_id' => $request->brand_id,
        ]);

        return response()->json();
    }

    public function update(Request $request, $id){

        $uacs = DmdUacs::findOrFail($id);

        $uacs->update([
            'dmd_id' => $request->dmd_id,
            'code' => $request->code,
            'brand_id' => $request->brand_id,
        ]);

        return response()->json();

    }

    public function search(Request $request){
        $data = Dmd_2::with('dmd_uacs')
        ->where('dmddesc', 'like', '%'.$request->word.'%')
        ->orderBy('dmddesc', 'asc')
        ->get();

        return response()->json($data);
    }

    public function get_needed_code(){
        
        $data = DB::table("fn_need_uacs_code()")->get();

        return response()->json($data);
    }

    public function search_need_code(Request $request){


    }
}
