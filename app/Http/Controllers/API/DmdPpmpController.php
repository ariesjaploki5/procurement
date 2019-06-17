<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Views\Dmds;
use App\Models\Ppmp;
use App\Models\DmdPpmp;
use DB;

class DmdPpmpController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
        $dmds = Dmds::orderBy('dmd_id', 'asc')->get();
        $count = count($dmds);
        $ppmp = Ppmp::create([
            'ppmp_year' => $request->ppmp_year,
            'category_id' => $request->category_id,
        ]);

        for($i = 0; $i < $count; $i++){
            $id = $dmds[$i]->dmd_id;
            $ppmp->dmds()->attach($id);
        }
        
        return response()->json();
    }

    public function show($id){
        $data = DB::SELECT("SELECT * FROM procurement.dbo.view_dmd_ppmp where ppmp_id = $id order by gendesc asc");

        return response()->json($data);
    }

    public function update2(Request $request, $id){
        $count = $request->dmds;
        $dmd = $request->dmds;
        for($i = 0; $i < $count; $i++){
            $id = $dmd[$i]['dmd_id'];
            $mode_id = $dmd[$i]['mode_id'];
            $budget = $dmd[$i]['budget'];
        }

        return response()->json();
    }

    public function update(Request $request, $id){
        $data = DmdPpmp::findOrFail($id);
        $data->update([
            'budget' => $request->budget,
            'mode_id' => $request->mode_id,
            'quantity' => $request->quantity,
            'unit_id' => $request->unit_id,
        ]);

        return response()->json();
    }

    public function destroy($id){
        $app = Ppmp::where('ppmp_id', $id)->delete();

        return response()->json($app);
    }
}
