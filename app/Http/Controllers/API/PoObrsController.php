<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PoObrs;
use DB;
use Carbon\Carbon;
use App\Models\PoUacsCode;
use App\Models\PurchaseOrder;

class PoObrsController extends Controller
{
    
    public function store(Request $request){
        
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $zero_month = sprintf('%02d', $month);


        $po_id = $request->po_id;
        $to_id = $request->type_of_obligation;
        $fund = $request->fund;
        $allotment_class = $request->allotment_class;
        $funding_source = $request->funding_source;
        $ta = $request->type_of_appropriation;

        $uacs_code = $request->uc;
        $count_uc = count($uacs_code);


        $obrs_date = Carbon::now();

        $fs = DB::table("procurement.dbo.funding_sources")
            ->where('id', $funding_source)
            ->first();
        
        $count = PoObrs::whereYear('created_at', $year)->count();

        $series = $count + 1; 
        $zero_series = sprintf('%04d', $series);

        if($ta == 1){

            $no = $fs->current_appropriations;
        
        } else {
           
            $no = $fs->continuing_appropriations;
        
        }

        $obrs_no = $fund.'-'.$allotment_class.'-'.$no.'-'.$year.'-'.$zero_month.'-'.$zero_series;

        $po_obrs = PoObrs::updateOrCreate([
            'po_id' => $po_id,
        ],[
            'obrs_no' => $obrs_no,
            'to_id' => $to_id,
            'fund_cluster' => $fs->fund_cluster,
        ]);

        $po_uacs_codes = PoUacsCode::where('po_id', $po_id)->delete();

        for($i = 0; $i < $count_uc; $i ++){
            $code = $uacs_code[$i]['code'];
            $amount = $uacs_code[$i]['amount'];

            $po_uacs_codes = PoUacsCode::create([
                'po_id' => $po_id,
                'uacs_code' => $code,
                'amount' => $amount,
                ]);
        }

        $po = PurchaseOrder::findOrFail($po_id);
        $po->update([
            'updated_at' => Carbon::now()
        ]);

        return response()->json();
    }

}
