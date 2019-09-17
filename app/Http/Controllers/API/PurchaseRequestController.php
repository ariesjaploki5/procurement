<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use App\Models\DmdPurchaseRequest;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use App\Models\DmdPurchaseOrder;
use App\Models\DmdPriceSchedule;
use DB;
use App\Models\DmdRfq;
use App\Models\Cart;
use App\Views\DmdPrDmdPo;
use App\Models\RequestForQuotation;

class PurchaseRequestController extends Controller
{

    public function index(){

        $data = PurchaseRequest::has('last_status.current_status')->with([
            'purchase_order', 'last_status.current_status', 'supplier', 'user', 'mode', 'rfq', 'purchase_request_remarks',
            'dmd_purchase_requests' => function($query){
                $query->with([ 
                    'dmd_price_schedule.new_dmd', 'dmd', 'new_app_dmd' => function($query){
                        $query->where('app_year', Carbon::now()->year)->first();
                    }
                ]);
            },
        ])->orderBy('created_at', 'desc')
        ->leftjoin('purchase_orders as po', 'purchase_requests.purchase_request_id', '=', 'po.purchase_request_id')
        ->leftjoin('purchase_order_status as pos', 'po.purchase_order_id', '=', 'pos.purchase_order_id')
        ->take(20)
        ->get();

        return response()->json($data);
    }

    public function search_pr(Request $request){

        $data = DB::SELECT("SELECT * FROM fn_filter_purchase_requests_search($request->word) order by purchase_request_id");


        return response()->json($data);
    }

    public function dmd_pr(){

        $data = DB::select("EXEC sp_dmd_pr");

        return $data;
    }

    public function for_pharmacy(){

        return response()->json();
    }

    public function for_cmps(){
        $data = DB::table("fn_purchase_requests()")
        ->where('csi', '<', 4)
        ->orderBy('csi', 'asc')
        ->orderBy('csi2', 'asc')
        ->get();

        return response()->json($data);
    }

    public function for_pmo(){

        $data = DB::table("fn_filter_purchase_requests()")
        ->orderBy('csi', 'asc')
        ->orderBy('csi2', 'asc')
        ->get();

        return response()->json($data);
    }

    public function new_for_pmo(){
        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 'rfq', 'purchase_request_remarks',
            'view_dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule' => function($query){
                        $query->first();
                    },
                ]);
            },
        ])
        ->where('created_at', '>=', Carbon::today())
        ->whereNotNull('div_head_rcv')
        ->whereNotNull('div_head_rls')
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($data);
    }

    public function new(){

        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 'rfq',
            'dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule.new_dmd', 'dmd', 'new_app_dmd' => function($query){
                        $query->where('app_year', Carbon::now()->year)->first();
                    }
                ]);
            },
        ])->where('created_at', '>=', Carbon::today())->orderBy('created_at', 'desc')->get();

        return response()->json($data);
    }

    public function public_bidding(){
        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 
            'view_dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule' => function($query){
                        $query->first();
                    },
                ]);
            },
        ])->where('mode_id', 1)->get();

        return response()->json($data);
    }

    public function shopping(){
        $data = PurchaseRequest::with([
            'supplier', 'user', 'mode', 
            'view_dmd_purchase_requests' => function($query){
                $query->with([
                    'dmd_price_schedule' => function($query){
                        $query->first();
                    },
                ]);
            },
        ])->where('mode_id', 4)->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $item = $request->items;
        $count = count($item);

        for($i = 0; $i < $count; $i++){
            $dmd_id = $item[$i]['dmd_id'];
            $request_quantity = $item[$i]['quantity'];
            $supplier_id = $item[$i]['dmd_price_schedule']['supplier_id'];

            $pr = PurchaseRequest::firstOrCreate([
                'user_id' => $request->user_id,
                'supplier_id' => $supplier_id,
            ]);
            
            $pr->dmds()->attach($dmd_id, ['request_quantity' => $request_quantity]);
        }

        return response()->json();
    }

    public function store_public_bidding(Request $request){
        $item = $request->items;
        $count = count($item);

        for($i = 0; $i < $count; $i++){
            $dmd_id = $item[$i]['dmd_id'];
            $request_quantity = $item[$i]['request_quantity'];
            $supplier_id = $item[$i]['dmd_price_schedule']['supplier_id'];

            $pr = PurchaseRequest::firstOrCreate([
                'user_id' => $request->user_id,
                'supplier_id' => $supplier_id,
            ]);
            
            $pr->dmds()->attach($dmd_id, ['request_quantity' => $request_quantity]);
        }

        return response()->json();
    }

    public function store_shopping(Request $request){
        $item = $request->items;
        $count = count($item);

        for($i = 0; $i < $count; $i++){
            $dmd_id = $item[$i]['dmd_id'];
            $request_quantity = $item[$i]['request_quantity'];
            $supplier_id = $item[$i]['dmd_price_schedule']['supplier_id'];

            $pr = PurchaseRequest::firstOrCreate([
                'user_id' => $request->user_id,
                'supplier_id' => $supplier_id,
            ]);
            
            $pr->dmds()->attach($dmd_id, ['request_quantity' => $request_quantity]);
        }

        return response()->json();
    }

    public function item_purchase_request($pr, $item){
        
        return response()->json();
    }

    public function show($id){

        $data = DB::SELECT("SELECT * FROM fn_dmd_purchase_request($id)");

        return response()->json($data);

    }

    public function get_pr($id){
        $data = DB::table("fn_filter_dmd_pr()")->where('purchase_request_id', $id)->first();

        return response()->jsoN($data);
    }

    public function get_total_amount($id){
        $data = DB::SELECT("procurement.dbo.fn_get_pr_total_amount($id)");

        return response()->json($data);
    }

    public function pr_show($id){

        $data = DB::SELECT("SELECT * FROM fn");

        return response()->json($data);
    }

    public function show_2($id){

        $data = DB::table('procurement.dbo.purchase_requests as tb1')
        ->join('procurement.dbo.dmd_purchase_request as tb2', 'tb1.purchase_request_id', '=', 'tb2.purchase_request_id')
        ->join('procurement.dbo.view_new_dmds as tb3', 'tb3.dmd_id', '=', 'tb3.dmd_id')
        ->join('procurement.dbo.app_dmd as tb4', 'tb3.dmd_id', '=','tb4.dmd_id')
        ->join('procurement.dbo.apps as tb5', 'tb4.app_id', '=', 'tb5.app_id')
        ->join('procurement.dbo.dmd_price_schedule as tb6', function($join){
            $join->where();
        })->where('tb5.app_year', Carbon::now()->year)
        ->get();

        return response()->json($data);

    }

    public function remove_dmd($id){
     
        return response()->json();
    }
    
    public function update(Request $request, $id){
        
        $dmd = $request->dmd_purchase_requests;
        $count = count($dmd);

        $pr = PurchaseRequest::findOrFail($id);
        $po = PurchaseOrder::create([
            'created_at' => $this->date_now()
        ]);

        $pr->update([
            'purchase_order_id' => $po->purchase_order_id,
        ]);

        for($i = 0; $i < $count; $i++){

            $dmd_pr = DmdPurchaseRequest::findOrFail($dmd[$i]['id']);
            $dmd_pr->update([
                'order_quantity' => $dmd[$i]['request_quantity'],
            ]);
        }

        return response()->json();
    }

    public function pr_to_po(Request $request){
        
        $year_month = Carbon::now()->format('Y-m');
        $year_now = Carbon::now()->year;

        $item = $request->items;
        $count = count($item);
        $purchase_request_id = $request->purchase_request_id;
        $pr_id = $request->pr_id;
        
        for($i = 0; $i < $count; $i++){

            $dmd_id = $item[$i]['dmd_id'];
            $quantity = $item[$i]['request_quantity'];
            
            $dmd = DB::table('procurement.dbo.dmd_price_schedule as tb1')
            ->join('procurement.dbo.price_schedules as tb2', 'tb1.price_schedule_id', '=', 'tb2.price_schedule_id')
            ->where('tb2.price_schedule_year', Carbon::now()->year)
            ->where('tb1.terminated', 0)
            ->where('tb1.dmd_id', $dmd_id)
            ->orderBy('tb1.rank', 'asc')
            ->first();

            $po = PurchaseOrder::firstOrCreate([
                'supplier_id' => $dmd->supplier_id,
                'purchase_request_id' => $purchase_request_id,
                'mode_id' => 1,
                'pr_id' => $pr_id,
            ]);

            if(!$po->po_id){
                $zero_id = sprintf("%04d", $po->purchase_order_id);
                $po->po_id = $year_month.'-'.$zero_id;
                $po->save();
            }

            $dmd_po = DmdPurchaseOrder::where('created_at', $year_now)->get();

            $count = count($dmd_po);
            $new_count = $count + 1;
            $list_no = sprintf( '%04d', $new_count );

            $po->dmd_purchase_orders()->create([
                'dmd_id' => $dmd_id,
                'order_quantity' => $quantity,
                'cost_price' => $dmd->bid_price,
                'brand_id' => $dmd->brand_id,
                'country_id' => $dmd->country_id,
                'packaging_id' => $dmd->packaging_id,
                'manufacturer_id' => $dmd->manufacturer_id,
                'list_no' => $list_no,
                'po_id' => $po->po_id
            ]);
        }

        return response()->json();
    }

    public function rfq_to_po(Request $request){

        $year_month = Carbon::now()->format('Y-m');

        $item = $request->items;
        $count = count($item);
        $purchase_request_id = $request->purchase_request_id;
        
        for($i = 0; $i < $count; $i++){

            $dmd_id = $item[$i]['dmd_id'];
            $quantity = $item[$i]['request_quantity'];
            $dmd_rfq_id = $item[$i]['dmd_rfq_id'];

            $dmd = DmdRfq::findOrFail($dmd_rfq_id);

            $po = PurchaseOrder::create([
                'supplier_id' => $dmd->supplier_id,
                'purchase_request_id' => $purchase_request_id,
                'mode_id' => 4,
            ]);

            if(!$po->po_id){
                $zero_id = sprintf("%04d", $po->purchase_order_id);
    
                $po->po_id = $year_month.'-'.$zero_id;
                $po->save();
            }

            $po->dmd_purchase_orders()->create([
                'dmd_id' => $dmd_id,
                'order_quantity' => $quantity,
                'cost_price' => $dmd->cost_unit,
                'brand_id' => $dmd->brand_id,
                // 'country_id' => $dmd->country_id,
                // 'packaging_id' => $dmd->packaging_id,
                'manufacturer_id' => $dmd->manufacturer_id,
                // 'purchase_order_id' => $po->purchase_order_id,
            ]);
        }

        return response()->json();
    }

    public function aoq_to_po(){
        $item = $request->view_dmd_purchase_requests;
        $count = count($item);
        $purchase_request_id = $request->purchase_request_id;
        
        for($i = 0; $i < $count; $i++){

            $dmd_id = $item[$i]['dmd_id'];
            $brand_id = $item[$i]['brand_id'];
            $manufacturer_id = $item[$i]['manufacturer_id'];
            $country_id = $item[$i]['country_id'];

            $po = PurchaseOrder::create([
                'supplier_id' => $supplier_id,
            ]); 
            
            $po->dmd_purchase_order()->create([
                'dmd_id' => $dmd_id, 
                'quantity' => $quantity,
                'purchase_order_id' => $po->purchase_order_id,
                'brand_id' => $brand_id,
                'manufacturer_id' => $manufacturer_id,
                'country_id' => $country_id,
                'cost_price' => $cost_price,
            ]);

        }

        return response()->json();
    }

    public function destroy($id){
        
        return response()->json();
    }

    public function pr_dmd_rqf($id){

        // $data = DB::table("fn_get_pr_dmd_rqf($id)")->get();
        // $data = 
        
        return response()->json($data);
    }

    public function approved($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->update([
            'status' => 1
        ]);

        return response()->json();
    }

    public function date_now(){
        return Carbon::now();
    }

    public function send_to_cmps($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->update([
            'send' => $this->date_now(),
            'current_status' => 'Send To CMPS',
        ]);

        $pr->purchase_request_statuses()->firstOrCreate([
            'current_status_id' => 1
        ]);

        return response()->json();
    }

    public function cmps_rcv($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->purchase_request_statuses()->firstOrCreate([
            'current_status_id' => 2
        ]);

        $pr->update([
            'updated_at' =>$this->date_now()
        ]);

        return response()->json();
    }

    public function cmps_rls($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->purchase_request_statuses()->firstOrCreate([
            'current_status_id' => 3
        ]);

        $pr->update([
            'updated_at' =>$this->date_now()
        ]);

        return response()->json();
    }

    public function pmo_rcv($id){

        $pr = PurchaseRequest::findOrFail($id);

        $pr->purchase_request_statuses()->firstOrCreate([
            'current_status_id' => 4
        ]);

        $pr->update([
            'updated_at' =>$this->date_now()
        ]);

        return response()->json();
    }

}
