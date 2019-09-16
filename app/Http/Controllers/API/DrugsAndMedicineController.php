<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Views\HomisDmd;
use App\Models\Dmd;
use DB;
use App\Events\DmdUpdated;
use Carbon\Carbon;
use App\Views\AppDmd;
use App\Models\Hdmhdrsub;
use App\Views\NewHomisDmd;
use App\Models\App;
use App\Views\NewAppDmd;
use App\Views\Dmd as Dmd_2;

class DrugsAndMedicineController extends Controller
{
    
    public function index(){


        $data = DB::SELECT("SELECT * from fn_dmd() order by dmddesc asc");

        return response()->json($data);
    }

    public function cmps_dmd(){

        $data = DB::table('fn_dmd()')->get();

        return response()->json($data);
    }

    public function need_to_pr(){

        $data = DB::SELECT("SELECT TOP(50) * from procurement.dbo.fn_dmd() where rop > (boh + iit) order by dmddesc asc");

        return response()->json($data);
    }

    public function index_2(){

        $now = Carbon::now();
        $year = $now->year;

        $data = AppDmd::with([
            'dmd_price_schedule', 'dmd_uacs' => function($query){
                $query->with([
                    'brand'
                ]);
            },
        ])->where('app_year', $year)->orderBy('gendesc', 'asc')->get();

        return response()->json($data);

    }

    public function dmd_uacs_2(){
        $data = Dmd_2::with('dmd_uacs')
        ->orderBy('dmddesc', 'asc')->get();

        return response()->json($data);
    }

    public function beg_bal(Request $request){

        $check = Hdmhdrsub::where('dmdctr', $request->dmdctr)
        ->where('dmdcomb', $request->dmdcomb)
        ->where('dmhdrsub', 'DRUM4')
        ->where('statusMed', 'A')
        ->get();

        $count = count($check);

        if($count > 0){

            DB::UPDATE("UPDATE Hospital.dbo.Hdmhdrsub SET stockbal = $request->stock
            WHERE dmdcomb = CAST('$request->dmdcomb' as varchar(12)) AND dmdctr = $request->dmdctr AND dmhdrsub = 'DRUM4';");

        } else {

            DB::INSERT("INSERT INTO Hospital.dbo.Hdmhdrsub(dmdctr, dmdcomb, dmhdrsub, statusMed, stockbal) 
            VALUES ($request->dmdctr, CAST('$request->dmdcomb' as varchar(12)), 'DRUM4', 'A', $request->stock);");
            
        }

        return response()->json();
    }

    public function for_mmo(){

        $data = DB::table("fn_mmo_dmds()")->orderby('dmddesc', 'asc')->get();

        return response()->json($data);
    }

    public function terminated(){

        $data = DB::SELECT("SELECT * FROM procurement.dbo.view_terminated");

        return response()->json($data);
    }

    public function need_to_receive(){

        $data = DB::SELECT("SELECT * FROM dbo.view_need_to_receive");

        return response()->json($data);
    }

    public function search(Request $request){
        
        $word = $request->word;

        $data = DB::table("fn_dmd()")
        ->where('dmddesc', 'like', '%'.$word.'%')
        ->orderBy('dmddesc', 'asc')
        ->get();

        return response()->json($data);

    }

    public function update_ssl(Request $request, $id){

        $ssl = $request->ssl;

        $update = DB::UPDATE("UPDATE procurement.dbo.dmds SET ssl = $ssl WHERE dmd_id = $id");

        broadcast(new DmdUpdated($update));

        return response()->json();

    }

    public function dmd_pr(Request $request, $id){

        $data = DB::SELECT("SELECT *, CAST(quantity as int) as int_quantity FROM procurement.dbo.view_for_pr ORDER BY gendesc ASC");

        return response()->json($data);
    }

    public function public_bidding(){
        
        $data = DB::SELECT("SELECT *, CAST(quantity as int) as int_quantity FROM procurement.dbo.view_dmd_for_pr_public_bidding ORDER BY gendesc ASC");
        
        return response()->json($data);
    }

    public function shopping(){


        return response()->json();
    }

    public function store(Request $request){
        

    }

    public function update_unit(Request $request){
        $dmd = DB::table('dmds')->where('dmd_id', $request->dmd_id)->update([
            'unit_id' => $request->unit_id,
        ]);

        return response()->json();
    }

    public function update(){


    }

    public function destroy(){


    }
}
