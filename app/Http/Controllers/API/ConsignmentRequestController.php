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
        $data = ConsignmentRequest::all();
    
        return response()->json($data);
    }

    public function show($id){
        $data = ConsignmentRequest::with([
            'details' => function($query){
                $query->with([
                    'mds_consignment'
                ]);
            },
        ])->where('crID', $id)->first();


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
}
