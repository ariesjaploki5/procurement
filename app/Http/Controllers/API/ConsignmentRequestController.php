<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ConsignmentRequest;
use Carbon\Carbon;
use DB;

class ConsignmentRequestController extends Controller
{
    public function index(){

        $data = DB::table("hospital.les.medicalSuppliesConsignmentRequest as tb1")
        ->join("hospital.dbo.hperson as tb2", "tb1.hpercode", "=", "tb2.hpercode")
        ->whereNotNull('tb1.hpercode')
        ->whereNUll('tb1.enccode')
        ->select(DB::raw("tb2.patfirst + ' ' + tb2.patmiddle + ' ' + tb2.patlast as fullname"), 'tb1.*')
        ->get();

        return response()->json($data);
    }

    public function with_enccode(){

        $data = DB::table("hospital.les.medicalSuppliesConsignmentRequest as tb1")
        ->join("hospital.dbo.hperson as tb2", "tb1.hpercode", "=", "tb2.hpercode")
        ->whereNotNull('tb1.hpercode')
        ->whereNotNull('tb1.enccode')
        ->select(DB::raw("tb2.patfirst + ' ' + tb2.patmiddle + ' ' + tb2.patlast as fullname"), 'tb1.*')
        ->get();

        return response()->json($data);
        
    }

    public function show($id){

        $data = ConsignmentRequest::with([
            'hperson' => function($query){
                $query->select('hpercode', 'patlast', 'patfirst', 'patmiddle', 
                DB::raw("patfirst + ' ' + patmiddle + ' ' + patlast as fullname"));
            },
            'details' => function($query){
                $query->with([
                    'mds_consignment'
                ]);
            },
        ])->where('crID', $id)
        ->first();

        return response()->json($data);

    }

    public function date_time(){
        return Carbon::now();
    }

    public function store(Request $request){

        $cr = ConsignmentRequest::create([
            'crID' => $request->crID, 
            'crDept'  => $request->crDept, 
            'crSection'  => $request->crSection, 
            'crDate'  => $request->crDate, 
            'tCreated'  => $this->date_time(), 
            'crStat' => $request->crStat, 
            'entryby' => $request->entryby
        ]);

    }

    public function update(Request $request, $id){

        $cr = ConsignmentRequest::findOrFail($id);

        $cr->update([
            'enccode' => $request->enccode,

        ]);

    }

    public function change_patient($id, $hpercode){

        $cr = ConsignmentRequest::findOrFail($id);
        $cr->update([
            'hpercode' => $hpercode,
        ]);

        return response()->json();

    }
}
