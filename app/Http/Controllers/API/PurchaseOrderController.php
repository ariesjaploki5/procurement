<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\DmdPurchaseRequest;
use DB;
use App\Models\Hdmhdrsub;
use App\Views\DmdPurchaseOrder;

use Carbon\Carbon;

class PurchaseOrderController extends Controller
{

    public function mmo_dmd_po(){
        
        $data = DB::table('fn_mmo_dmd_po()')
        ->orderBy('po_id', 'desc')
        ->orderBy('dmddesc', 'asc')
        ->take(20)
        ->get();


        return response()->json($data);
    }

    public function mmo_dmd_po_search(Request $request){
        $data = DB::table('fn_mmo_dmd_po()')
        ->where('po_id', 'like', '%'.$request->word.'%')
        ->orderBy('po_id', 'desc')
        ->orderBy('dmddesc', 'asc')
        ->get();

        return response()->json($data);
    }

    public function index(){
        $data = PurchaseOrder::with([
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request', 'dmd_purchase_orders' => function($query){
                $query->with([
                    'manufacturer', 'brand', 'country', 'packaging', 'new_dmd',
                ]);
            },
        ])->get();

        return response()->json($data);
    }

    public function terminate_po(Request $request, $id){
        $po = PurchaseOrder::findOrFail($id);
        $po->update([
            'terminated' => 1,
            'waiver' => $request->waiver,
        ]);
        
        return response()->json();
    }

    public function for_vr(){
        $po = DB::SELECT("SELECT * FROM procurement.dbo.view_for_pr");

        return response()->json($po);
    }

    public function get_po($id){

        $data = PurchaseOrder::with([
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request', 'dmd_purchase_orders' => function($query){
                $query->with([
                    'manufacturer', 'brand', 'country', 'packaging', 'new_dmd', 'dmd_receiveds',
                ]);
            },
        ])
        ->whereNotNull('date_of_delivery')
        ->whereNotNull('delivery_term')
        ->whereNotNull('fund_source_id')
        ->whereNotNull('allotment_id')
        ->whereNotNull('uacs_id')
        ->whereNotNull('obrs_date')
        ->whereNotNull('budget_rls')
        ->whereNotNull('pmo_rls')
        ->whereNotNUll('accntng_rls')
        ->whereNotNull('fmo_rls')
        ->whereNotNull('mcc_rls')
        ->where('purchase_order_id', $id)->first();

        return response()->jsoN($data);
    }

    public function receive_dmd(Request $request){

        $id = $request->id;
        $dmd_id = $request->dmd_id;
        $purchase_request = $request->purchase_request_id;
        $received_quantity = $request->received_quantity;
        $dmdctr = $request->dmdctr;
        $dmdcomb = $request->dmdcomb;
        
        $check = DB::SELECT("SELECT * FROM hospital.dbo.hdmhdrsub WHERE dmhdrsub = 'DRUM4' AND dmdcomb = $dmdcomb AND dmdctr = $dmdctr");
        $count_check = count($check);

        $dmd_pr = DmdPurchaseRequest::findOrFail($id);
        $dmd_pr->update([
            'received_quantity' => $received_quantity,
        ]);

        if($count_check > 0){

            $hd = Hdmhdrsub::where('dmdcomb', $dmdcomb)->where('dmdctr', $dmdctr)->where('dmhdrsub', 'DRUM4')->first();
            $hd->update(['stockbal' + $received_quantity]);
            
        } else {

            $hd = Hdmhdrsub::create([
                'dmdcomb' => $dmdcomb, 
                'dmdctr' => $dmdctr, 
                'dmhdrsub' => 'DRUM4', 
                'statusMed' => 'A',
                'stockbal' => $received_quantity
            ]);
        }

        return response()->json();
    }

    public function received_dmd(Request $request){
        $dmd = $request->items;
        $count = count($dmd);

        for($i = 0; $i < $count; $i++){

            $received_quantity = $dmd[$i]['request_quantity'];
            $dmdcomb = $dmd[$i]['dmdcomb'];
            $dmdctr = $dmd[$i]['dmdctr'];
            $id = $dmd[$i]['id'];

            $dmd_pr = DmdPurchaseRequest::findOrFail($id);
            $dmd_pr->update([
                'received_quantity' => $received_quantity,
            ]);

            
            $check = DB::SELECT("SELECT * FROM hospital.dbo.hdmhdrsub WHERE dmhdrsub = 'DRUM4' AND dmdcomb = $dmdcomb AND dmdctr = $dmdctr");
            $count_check = count($check);

            if($count_check > 0){

                $hd = Hdmhdrsub::where('dmdcomb', $dmdcomb)->where('dmdctr', $dmdctr)->where('dmhdrsub', 'DRUM4')->first();
                $hd->update(['stockbal' + $received_quantity]);
                
            } else {

                $hd = Hdmhdrsub::create([
                    'dmdcomb' => $dmdcomb, 
                    'dmdctr' => $dmdctr, 
                    'dmhdrsub' => 'DRUM4', 
                    'statusMed' => 'A',
                    'stockbal' => $received_quantity
                ]);
            }
        }

        $po = PurchaseOrder::findOrFail($request->purchase_order_id);
        $po->update([
            'terminated' => 2
        ]);


        return response()->json();
    }


    public function notice_to_terminate($id){
        
        $po = PurchaseOrder::findOrFail($id);
        
        $po->update([
            'notice' => 1
        ]);

        return response()->json();
    }

    public function terminate(Request $request){
        
        $po = PurchaseOrder::findOrfail($request->purchase_order_id);
        
        $po->update([
            'terminated' => 1,
            'waiver' => 1
        ]);

        return response()->json();
    }

    public function transfer_stock(Request $request){

        
        $dmd_id = $request->dmd_id;

        $dmd = Dmd::findOrFail($dmd_id);

        $dmdcomb = $dmd->dmdcomb;
        $dmdctr = $dmd->dmdctr;
        $balance = $request->balance;


        return response()->json();
    }

    public function store_dod(Request $request){

        $po = PurchaseOrder::findOrFail($request->purchase_order_id);

        $po->update([
            'date_of_delivery' => $request->date_of_delivery,
            'delivery_term' => $request->delivery_term,
            'dod' => 1
        ]);

        return response()->json();
    }

    public function store_pod(Request $request){
        $po = PurchaseOrder::findOrFail($request->purchase_order_id);

        $po->update([
            'payment_term_id' => $request->payment_term_id,
            'place_of_delivery' => $request->place_of_delivery,
            'pod' => 1
        ]);

        return response()->json();
    
    }


    public function store_update_obrs(Request $request){
        $date = Carbon::now();

        $po = PurchaseOrder::findOrFail($request->purchase_order_id);

        $po->update([
            'allotment_id' => $request->allotment_id,
            'amount' => $request->amount,
            'fund_cluster_id' => $request->fund_cluster_id,
            'fund_source_code_id' => $request->fund_source_code_id,
            'fund_source_id' => $request->fund_source_id,
            'obrs_date' => $date,
            'uacs_code_id' => $request->uacs_code_id,
            'ors_burs' => $request->ors_burs,
        ]);

        return response()->json($po);
    }

    public function pmo_show($id){

        $data = DB::table('purchase_orders as po')
        ->join('dmd_purchase_orders as dpo', 'po.purchase_order_id', '=', 'dpo.purchase_order_id')
        ->where('po.purchase_order_id', $id)
        ->get();
        
        return response()->json($data);
    }

    public function search_po(Request $request){

        $word = $request->word;

        $data = DB::SELECT("SELECT * FROM fn_filter_purchase_orders_search($word) order by purchase_order_id");

        return response()->json($data);
    }

    public function for_pmo(){

        $data = DB::table('fn_filter_purchase_orders_3()')->get();

        return response()->json($data);

    }
    
    public function for_cmps(){

        $data = DB::table('fn_filter_purchase_orders(4, 7)')->get();

        return response()->json($data);
    }

    public function for_budget(){
        
        $data = DB::table('fn_filter_purchase_orders_2(7, 8, 21)')->get();

        return response()->json($data);
    }

    public function for_accounting(){

        $data = DB::table('fn_filter_purchase_orders(8, 11)')->get();

        return response()->json($data);
    }

    public function for_fmo(){

        $data = DB::table('fn_filter_purchase_orders(10, 13)')->get();

        return response()->json($data);
    }

    public function for_mcc(){

        $data = DB::table('fn_filter_purchase_orders(12, 15)')->get();

        return response()->json($data);
    }

    public function for_mmo(){

        $data = DB::table('fn_filter_purchase_orders_4(26)')
        ->orderBy('po_id', 'desc')
        ->get();

        return response()->json($data);
    }

    public function search_for_mmo(Request $request){
        $data = DB::table('fn_filter_purchase_orders_4(26)')
        ->where('po_id', 'like', '%'.$request->word.'%')
        ->orderBy('po_id', 'desc')
        ->get();

        return response()->json($data);
    }

    public function store(Request $request){

        $item = $request->items;
        $count = count($item);
        $purchase_request_id = $request->purchase_request_id;
        $supplier_id = $request->supplier_id;

        for($i = 0; $i < $count; $i++){
            $dmd_id = $item[$i]['dmd_id'];
            $price = $item[$i]['bid_price'];
            $quantity = $item[$i]['quantity'];

            $po = PurchaseOrder::create([
                'purchase_request_id' => $purchase_request_id,
                'dmd_id' => $dmd_id,
                'price' => $price,
                'supplier_id' =>  $supplier_id,
                'quantity' => $quantity,
            ]);

        }

        return response()->json();
    }

    public function show($id){

        // $data = DB::SELECT("SELECT * FROM fn_dmd_purchase_orders($id) order by dmddesc asc");

        $data = DmdPurchaseOrder::with([
            'dmd_po_receiveds'
        ])->where('purchase_order_id', $id)->get();

        return response()->json($data);
    }

    public function get_attachments($id){
        $po = DB::Table("fn_get_dv($id)")->first();

        $array_1 = array(
            ["attachment" => $po->po_no], 
            ["attachment" => $po->pr_id], 
            ["attachment" => $po->ors_burs_no],
            // ["attachment" => $po->total_amount]
        );

        $iar = DB::Table("fn_get_iar($id)")->get();

        $array_2 = array();

        foreach($iar as $i){
            $array_2[] = $i; 
        }

        $merge_array = array_merge($array_2, $array_1);

        return response()->json($merge_array);
    }

    public function get_dv_item($id){
        $item = DB::Table("fn_get_dv($id)")->first();
        

        return response()->json($item);
    }

    public function purchase_order_obrs($id){
        $data = DB::table("fn_dmd_purchase_orders($id)")->take(1)->first();
        return response()->json($data);
    }

    public function po_show($id){
        $data = DB::table("fn_purchase_orders()")->where('purchase_order_id', $id)->first();

        return response()->json($data);
    }

    public function budget_show($id){

        $data = DB::SELECT("exec procurement.dbo.sp_cons $id");
    
        return response()->json($data);
    
    }

    public function update(Request $request, $id){
        

        return response()->json();
    }

    public function destroy($id){
        
        
        return response()->json();
    }

    public function date_now(){
        return Carbon::now();
    }
    
    public function pmo_rls_po($id){

        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 5
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();
    }

    public function pmo_rcv_po_2($id){

        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 5
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();
    }

    public function pmo_rls_po_2($id){

        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 5
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();
    }
    
    public function cmps_rcv_po($id){
    
        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 6
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }

    public function pmo_to_mmo($id){
        
        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 26
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }
    
    public function cmps_rls_po($id){
    
        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 7
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    
    }

    public function budget_rcv($id){

        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 8
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();

    }
    
    public function budget_rls($id){

        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 9
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();

    }
    
    public function accounting_rcv($id){

        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 10
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();

    }
    
    public function accounting_rls($id){

        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 11
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();
    }
    
    public function fmo_rcv($id){
        
        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 12
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();
    }
    
    public function fmo_rls($id){
    
        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 13
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    
    }
    
    public function mcc_rcv($id){
        
        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 14
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    
    }
    
    public function mcc_rls($id){
        
        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 15
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    
    }
    
    public function mmo_rcv($id){
    
        $po = PurchaseOrder::findOrFail($id);
        
        $po->purchase_order_statuses()->create([
            'current_status_id' => 16
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    
    }
    
    public function pharmacy_rtn($id){

        $po = PurchaseOrder::findOrFail($id);
        
        $po->purchase_order_statuses()->create([
            'current_status_id' => 18
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();

    }

    public function cmps_rtn_po($id){
        $po = PurchaseOrder::findOrFail($id);
        
        $po->purchase_order_statuses()->create([
            'current_status_id' => 19
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }

    public function pmo_rtn_po($id){
        $po = PurchaseOrder::findOrFail($id);
        
        $po->purchase_order_statuses()->create([
            'current_status_id' => 20
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }

    public function budget_rtn($id){
        $po = PurchaseOrder::findOrFail($id);
        
        $po->purchase_order_statuses()->create([
            'current_status_id' => 21
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }

    public function accounting_rtn($id){
        $po = PurchaseOrder::findOrFail($id);
        
        $po->purchase_order_statuses()->create([
            'current_status_id' => 22
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }

    public function fmo_rtn($id){
        $po = PurchaseOrder::findOrFail($id);
        
        $po->purchase_order_statuses()->create([
            'current_status_id' => 21
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }

    public function mcc_rtn($id){
        $po = PurchaseOrder::findOrFail($id);
        
        $po->purchase_order_statuses()->create([
            'current_status_id' => 20
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }

    public function mmo_rtn($id){
        $po = PurchaseOrder::findOrFail($id);
        
        $po->purchase_order_statuses()->create([
            'current_status_id' => 25
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }
}
