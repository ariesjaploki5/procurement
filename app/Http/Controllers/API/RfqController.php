<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestForQuotation as Rfq;
use App\Models\DmdRfq;
use Carbon\Carbon;
use App\Views\Dmds;
use DB;

class RfqController extends Controller
{
    public function index(){
        $year = Carbon::now()->year;  
        $data = Rfq::with([
            'purchase_request' => function($query) use($year){
                $query->with([
                    'view_dmd_purchase_requests' => function($query) use ($year){
                        $query->with([
                            'app_dmd' => function($query) use($year){
                                $query->where('app_year', $year);
                            },
                            'dmd_rfqs' => function ($query){
                                $query->with([
                                    'brand', 'manufacturer',
                                ]);
                            }
                        ]);
                    },
                ])->get();
            },
        ])->get();

        return response()->json($data);
    }

    public function show($id){
        $year = Carbon::now()->year;

        $data = Rfq::with([
            'purchase_request' => function($query) use($year){
                $query->with([
                    'view_dmd_purchase_requests' => function($query) use ($year){
                        $query->with([
                            'app_dmd' => function($query) use($year){
                                $query->where('app_year', $year);
                            },
                            'dmd_rfqs' => function ($query){
                                $query->with([
                                    'brand', 'manufacturer',
                                ]);
                            }
                        ]);
                    },
                    
                ])->get();
            },
        ])->where('rfq_id', $id)->first();

        return response()->json($data);
    }

    public function store(Request $request){

        $rfq = Rfq::create([
            'purchase_request_id' => $request->purchase_request_id,
        ]);

        return response()->json();
    }

    public function add_rfq(Request $request, $id){
        $rfq_id = $id;
        $rfq = DmdRfq::create([
            'rfq_id' => $rfq_id,
            'dmd_id' => $request->dmd_id,
            'brand_id' => $request->brand_id,
            'manufacturer_id' => $request->manufacturer_id,
            'cost_unit' => $request->cost_unit,
        ]);
        
        return response()->json();
    }

    public function update(Request $request, $id){
        $rfq = DmdRfq::findOrFail($id);
        $rfq->update([
            'brand_id' => $request->brand_id,
            'manufacturer_id' => $request->manufacturer_id,
            'cost_unit' => $request->cost_unit,
        ]);
        
        return response()->json();
    }

    public function destroy($id){
        $rfq = DmdRfq::where('id', $id)->first();
        $rfq->delete();

        return response()->json();
    }
}
