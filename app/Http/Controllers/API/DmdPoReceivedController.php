<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DmdPoReceived;
use App\Models\DmdUacs;
use DB;
use Carbon\Carbon;

class DmdPoReceivedController extends Controller
{
    
    public function index(){

    }

    public function store(Request $request){

        $year_now = Carbon::now()->year;
        $month_now = Carbon::now()->month;
        
        $count = DmdPoReceived::where(DB::raw('YEAR(created_at)'), $year_now)->count();
        $new_count = $count + 1;
        $iar_no = sprintf( '%04d', $new_count );
        $month = sprintf('%02d', $month_now);
        $iar_now_m_y = $year_now.'-'.$month.'-'.$iar_no;

        $items = $request->items;

        $dmd_po_r = DmdPoReceived::create([
            'list_no' => $request->list_no,
            'receiving_officer_id' => $request->officer_id,
            'inspection_officer_id' => $request->inspector_id,
            'received_quantity' => $request->order_quantity,
            'remarks' => $request->remarks,
            'date_received' => $request->date_received,
            'expiry_date' => $request->expiry_date,
            'dmd_po_id' => $request->dmd_po_id,
            'iar_no' => $iar_now_m_y,
            'days_delayed' => $request->days_delayed,
        ]);

        $dmd_uacs = DmdUacs::firstOrCreate([
            'dmd_id' => $request->dmd_id,
            'brand_id' => $request->brand_id
        ]);

        $last_quantity = $dmd_uacs->stock_quantity;
        $new_stock = $last_quantity + $request->order_quantity;
        $dmd_uacs->stock_quantity = $new_stock;

        $dmd_uacs->save();

        return response()->json();
    }

    public function update(Request $request, $id){

        $year_now = Carbon::now()->year;
        $month_now = Carbon::now()->month;
        
        $c = DmdPoReceived::where(DB::raw('YEAR(created_at)'), '=', $year_now)->get();

        $count = count($c);
        $new_count = $count + 1;

        $iar_no = sprintf( '%04d', $new_count );
        $month = sprintf('%02d', $month_now);
        $iar_now_m_y = $year_now.'-'.$month.'-'.$iar_no;

        $dmd_po_r = DmdPoReceived::create([
            'list_no' => $request->list_no,
            'receiving_officer_id' => $request->officer_id,
            'inspection_officer_id' => $request->inspector_id,
            'received_quantity' => $request->order_quantity,
            'remarks' => $request->remarks,
            'date_received' => $request->date_received,
            'expiry_date' => $request->expiry_date,
            'dmd_po_id' => $request->dmd_po_id,
            'iar_no' => $iar_now_m_y,
            'days_delayed' => $request->days_delayed,
        ]);

        $dmd_uacs = DmdUacs::firstOrCreate([
            'dmd_id' => $request->dmd_id,
            'brand_id' => $request->brand_id
        ]);

        $last_quantity = $dmd_uacs->stock_quantity;
        $new_stock = $last_quantity + $request->order_quantity;
        $dmd_uacs->stock_quantity = $new_stock;

        $dmd_uacs->save();

        return response()->json();
    }

    public function show($id){


    }

    public function destroy($id){


    }
}
