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

class DrugsAndMedicineController extends Controller
{
    public function index(){
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

    public function search(Request $request){
        
        $word = $request->word;
        $data = DB::SELECT("SELECT * FROM procurement.dbo.view_dmds WHERE gendesc LIKE '$word%' ORDER BY gendesc ASC");

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
        return DB::SELECT("SELECT *, CAST(quantity as int) as int_quantity FROM procurement.dbo.view_dmd_for_pr_public_bidding ORDER BY gendesc ASC");
    }

    public function shopping(){
        return response()->json();
    }

    public function store(Request $request){
        
    }

    public function update(){

    }

    public function destroy(){

    }
}
