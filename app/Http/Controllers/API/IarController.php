<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Iar;
use App\Models\IarBatch;
use App\Models\DmdUacs;
use Carbon\Carbon;
use App\Models\DmdPurchaseOrder;


class IarController extends Controller
{
    public function index(){

        $data = DB::table("procurement.dbo.fn_get_all_iar()")->get();
        return response()->json($data);

    }


    public function store(Request $request){



        $year_now = Carbon::now()->year;
        $month_now = Carbon::now()->month;
        $count = Iar::where(DB::raw('YEAR(created_at)'), $year_now)->count();
        $new_count = $count + 1;
        
        $iar_no = sprintf( '%04d', $new_count );
        $month = sprintf('%02d', $month_now);
        $iar_now_m_y = $year_now.'-'.$month.'-'.$iar_no;

        $iar = Iar::create([
            'iar_no' => $iar_now_m_y,
            'po_id' => $request->po_id,
            'date_received' => $request->date_received,
            'officer_id' => $request->officer_id,
            'officer_inspected' => $request->officer_inspected,
            'inspector_id' => $request->inspector_id,
            'inspector_inspected' => $request->inspector_inspected,
            'invoice_date' => $request->invoice_date,
            'invoice_no' => $request->invoice_no,
        ]);

        $item = $request->items;
        $count = count($item);

        for($i = 0;$i < $count; $i++){

            $ib_count = IarBatch::where('iar_no', $iar->iar_no)->count();
            $new_no = $ib_count + 1;

            $iar_batch = IarBatch::create([
                'iar_no' => $iar->iar_no, 
                'batch_no' => $item[$i]['batch_no'],
                'dmd_id' => $item[$i]['dmd_id'], 
                'received_quantity' => $item[$i]['received_quantity'],
                'expiry_date' => $item[$i]['expiry_date'], 
                'remarks' => $item[$i]['remarks']
            ]);

            $dmd_po = DmdPurchaseOrder::where('po_id', $request->po_id)
                ->where('dmd_id', $item[$i]['dmd_id'])
                ->first();

            $dmd_po->total_received = $item[$i]['received_quantity'] + $dmd_po->total_received;
            
            $dmd_po->save();
        }

        return response()->json();
    }

    public function update(Request $request, $id){

        $iar = IarBatch::find($id);
        $iar->update([
            'iar_no' => $request->iar_no,
            'dmd_id' => $request->dmd_id,
            'expiry_date' => $request->expiry_date,
            'received_quantity' => $request->received_quantity,
            'batch_no' => $request->batch_no, 
        ]);


        return response()->json();
    }

    public function show($id){


    }

    public function destroy($id){


    }

    
}
