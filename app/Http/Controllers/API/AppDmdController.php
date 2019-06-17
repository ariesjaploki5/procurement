<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Views\Dmds;
use App\Models\App;
use App\Models\AppDmd;
use DB;

class AppDmdController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
        $dmds = Dmds::orderBy('dmd_id', 'asc')->get();
        $count = count($dmds);
        $app = App::create([
            'app_year' => $request->app_year,
            'app_budget' => $request->app_budget,
            'category_id' => $request->category_id,
        ]);
        for($i = 0; $i < $count; $i++){
            $id = $dmds[$i]->dmd_id;
            $app->dmds()->attach($id);
        }
        
        return response()->json();
    }

    public function show($id){
        $data = DB::SELECT("SELECT * FROM procurement.dbo.view_app_dmd where app_id = $id order by gendesc asc");
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
        $data = AppDmd::findOrFail($id);
        $data->update([
            'budget' => $request->budget,
            'mode_id' => $request->mode_id,
            'quantity' => $request->quantity,
            'unit_id' => $request->unit_id,
        ]);

        return response()->json();
    }

    public function destroy($id){
        $app = App::where('app_id', $id)->delete();

        return response()->json($app);

    }
}
