<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\DmdPurchaseRequest;
use DB;
use App\Models\Hdmhdrsub;

use Carbon\Carbon;

class PurchaseOrderController extends Controller
{

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


    public function terminate_po($id){
        $po = PurchaseOrder::findOrFail($id);
        $po->update([
            'terminated' => 1,
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

        // $data = PurchaseOrder::with([
        //     'dmd_purchase_orders' => function($query){
        //         $query->with([
        //             'brand', 'manufacturer', 'packaging', 'country', 'new_dmd'
        //         ]);
        //     }, 'supplier'
        // ])->where('purchase_order_id', $id)->first();

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

    public function store_date_of_delivery(Request $request){
        $po = PurchaseOrder::findOrFail($request->purchase_order_id);
        $po->update([
            'date_of_delivery' => $request->date_of_delivery,
            'delivery_term' => $request->delivery_term,
            'dod' => 1
        ]);

        return response()->json();
    }

    public function store_update_obrs(Request $request){
        $date = Carbon::now();

        $po = PurchaseOrder::findOrFail($request->purchase_order_id);

        $po->update([
            'allotment_id' => $request->allotment_id,
            'uacs_id' => $request->uacs_id,
            'fund_source_id' => $request->fund_source_id,
            'amount' => $request->amount,
            'obrs_date' => $date,
        ]);

        return response()->json($po);
    }



    public function for_pmo(){
        
        $latestPoStatus = DB::table('purchase_order_status')
        ->select('purchase_order_id', DB::raw('MAX(current_status_id) as current_status_id'))
        ->groupBy('purchase_order_id');

        $purchaseOrders = DB::table('purchase_orders as po')
        ->joinSub($latestPoStatus, 'latest_po_status', function($join){
            $join->on('po.purchase_order_id', '=', 'latest_po_status.purchase_order_id');
        })->select('po.purchase_order_id', 'po.purchase_request_id','latest_po_status.current_status_id');

        $data = PurchaseOrder::with([
            'last_status.current_status',
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request.last_status.current_status', 
            'dmd_purchase_orders' => function($query){
                $query->with([
                    'manufacturer', 'brand', 'country', 'packaging', 'new_dmd',
                ]);
            },
        ])
        ->joinSub($latestPoStatus, 'latest_po_status', function($join){
            $join->on('purchase_orders.purchase_order_id', '=', 'latest_po_status.purchase_order_id');
        })
        ->where('current_status_id', '<', 5)
        ->get();

        return response()->json($data);

    }
    
    public function for_cmps(){
        $data = PurchaseOrder::with([
            'purchase_request' => function ($query){
                $query->with(['view_dmd_purchase_requests']);
            }
        ])->get();

        return response()->json($data);
    }

    public function search_po(Request $request){
        $data = PurchaseOrder::whereHas('last_status')
        ->with([
            'last_status.current_status',
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request.last_status.current_status', 
            'dmd_purchase_orders' => function($query){
                $query->with([
                    'manufacturer', 'brand', 'country', 'packaging', 'new_dmd',
                ]);
            },
        ])
        ->where('po_id', 'like', "%$request->word%")
        ->take(50)
        ->get();


        return response()->json($data);
    }

    public function for_budget(){
        $data = PurchaseOrder::whereHas('last_status')
        ->with([
            'last_status.current_status',
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request.last_status.current_status', 
            'dmd_purchase_orders' => function($query){
                $query->with([
                    'manufacturer', 'brand', 'country', 'packaging', 'new_dmd', 'new_dmd_homis'
                ]);
            },
        ])->get();


        return response()->json($data);
    }

    public function for_accounting(){
        $data = PurchaseOrder::whereHas('last_status')
        ->with([
            'last_status.current_status',
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request.last_status.current_status', 
            'dmd_purchase_orders' => function($query){
                $query->with([
                    'manufacturer', 'brand', 'country', 'packaging', 'new_dmd', 'new_dmd_homis'
                ]);
            },
        ])->get();


        return response()->json($data);
    }

    public function for_fmo(){
        $data = PurchaseOrder::whereHas('last_status')
        ->with([
            'last_status.current_status',
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request.last_status.current_status', 
            'dmd_purchase_orders' => function($query){
                $query->with([
                    'manufacturer', 'brand', 'country', 'packaging', 'new_dmd', 'new_dmd_homis'
                ]);
            },
        ])->get();


        return response()->json($data);
    }

    public function for_mcc(){
        $data = PurchaseOrder::whereHas('last_status')
        ->with([
            'last_status.current_status',
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request.last_status.current_status', 
            'dmd_purchase_orders' => function($query){
                $query->with([
                    'manufacturer', 'brand', 'country', 'packaging', 'new_dmd', 'new_dmd_homis'
                ]);
            },
        ])->get();


        return response()->json($data);
    }

    public function for_mmo(){
        $data = PurchaseOrder::whereHas('last_status')
        ->with([
            'last_status.current_status',
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request.last_status.current_status', 
            'dmd_purchase_orders' => function($query){
                $query->with([
                    'manufacturer', 'brand', 'country', 'packaging', 'new_dmd', 'new_dmd_homis'
                ]);
            },
        ])->get();


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

        // $carbon = Carbon::now()->subMonths(2);
        $carbon_now = Carbon::now();
        $carbon_two = Carbon::now()->subDays(60);

        // $twoMonths = DB::SELECT("SELECT tb1.dmd_id, SUM(tb2.qtyissued) as cons FROM procurement.dbo.dmds as tb1 inner join hospital.dbo.hrxo as tb2 on tb1.dmdcomb COLLATE DATABASE_DEFAULT = tb2.dmdcomb and tb1.dmdctr = tb2.dmdctr where tb2.dodate > DATEADD(month, -2, GETDATE()) GROUP BY tb1.dmd_id");

        $twoMonths = DB::table('hospital.dbo.hrxo as tb1')
        ->join('procurement.dbo.dmds as tb2', function($join) use($carbon_two){
            $join->on(DB::raw('tb1.dmdcomb collate Latvian_BIN'), '=', 'tb2.dmdcomb')->on('tb1.dmdctr', '=', 'tb1.dmdctr')
            ->where('tb1.dodate', '>', $carbon_two)
            ->where('tb1.orderfrom', '<>', 'DRUMO')
            ->where('tb1.orderfrom', '<>', 'DRUMF')
            ->where('tb1.orderfrom', '<>', 'DRUMK')
            ;
        })->select('tb2.dmd_id', DB::raw('SUM(tb1.qtyissued) as consumption'))
        // ->whereBetween('tb1.dodate', [$carbon_two, $carbon_now])
        ->where('tb1.orderfrom', 'DRUME')->where('tb1.orderfrom', 'DRUMO')->groupBy('tb2.dmd_id');

        // $data = DB::table('purchase_orders as po')
        // ->join('dmd_purchase_order as dpo', 'po.purchase_order_id', '=', 'dpo.purchase_order_id')
        // ->leftjoin('allotments as al', 'po.allotment_id', '=', 'al.allotment_id')
        // ->leftjoin('fund_sources as fs', 'po.fund_source_id', '=', 'fs.id')
        // ->leftjoin('uacs as u', 'po.uacs_id', '=', 'u.id')
        // ->leftjoin('suppliers as s', 'po.supplier_id', '=', 's.supplier_id')
        // ->join('purchase_requests as pr', 'po.purchase_request_id', '=', 'pr.purchase_request_id')
        // ->leftjoin('modes as m', 'po.mode_id', '=', 'm.mode_id')
        // ->joinSub($twoMonths, 'two_months', function($join){
        //     $join->on('dpo.dmd_id', '=', 'two_months.dmd_id');
        // })
        // ->where('po.purchase_order_id', $id)
        // ->select('po.*', 'm.mode_desc', 'fs.*', 'u.*')
        // ->first();

        $data = PurchaseOrder::with([
            'last_status.current_status',
            'mode',
            'allotment', 'fund_source', 'uacs', 'supplier',
            'purchase_request', 'dmd_purchase_orders' => function($query) use ($twoMonths){
                    $query->with([
                        'manufacturer', 'brand', 'country', 'packaging', 'new_dmd_homis', 'new_dmd'
                    ])->select(["dmd_purchase_order.*", 
                    "two_months.consumption", 
                    DB::raw("CAST((order_quantity * cost_price) as decimal(18, 2)) as amount"),])
                    // ->leftJoinSub($twoMonths, 'two_months', function($join){
                    //     $join->on('dmd_purchase_order.dmd_id', '=', 'two_months.dmd_id');
                    // })
                    ;
                },
            ])
            ->where('purchase_order_id', $id)
            ->first();

            return response()->json($data);
    }


    public function budget_show($id){
        $data = DB::SELECT("SELECT tb3.*, tb5.po_id, tb4.cons, tb6.boh, tb6.dmddesc, tb6.ssl  FROM procurement.dbo.dmd_purchase_order as tb3 left join 
        (SELECT SUM(tb1.qtyissued) as cons, tb2.dmd_id
        FROM hospital.dbo.hrxo as tb1
        inner join procurement.dbo.dmds as tb2 on tb1.dmdcomb COLLATE DATABASE_DEFAULT = tb2.dmdcomb and tb1.dmdctr = tb2.dmdctr
        where tb1.dodate > DATEADD(month, -2, GETDATE()) and
        tb1.orderfrom not in ('DRUMO','DRUMF','DRUMK')
        GROUP BY tb2.dmd_id) as tb4 on tb3.dmd_id = tb4.dmd_id
        left join purchase_orders as tb5 on tb3.purchase_order_id = tb5.purchase_order_id
        left outer join (
        SELECT atable.dmddesc, btable.boh, btable.dmdcomb, btable.dmdctr, ctable.dmd_id, ctable.ssl FROM (
        SELECT b.dmdctr, b.dmdcomb,
        CONVERT(varchar, c.gendesc) + ' ' +
        CONVERT(varchar, b.dmdnost) + ' ' + 
        CONVERT(varchar, f.stredesc) + ' ' + 
        CONVERT(varchar, d.formdesc) + ' ' + 
        CONVERT(varchar, COALESCE (b.brandname, '')) AS dmddesc 
        FROM
        hospital.dbo.hdruggrp AS a INNER JOIN
        hospital.dbo.hdmhdr AS b ON a.grpcode = b.grpcode INNER JOIN
        hospital.dbo.hgen AS c ON a.gencode = c.gencode INNER JOIN
        hospital.dbo.hform AS d ON b.formcode = d.formcode INNER JOIN
        hospital.dbo.hroute AS e ON b.rtecode = e.rtecode INNER JOIN
        hospital.dbo.hstre AS f ON b.strecode = f.strecode 
        WHERE (a.grpstat = 'A') AND (c.genstat = 'A') AND (b.dmdstat = 'A') AND (d.formstat = 'A') AND (e.rtestat = 'A') AND (b.dmdstat = 'A') AND (c.genstat = 'A') AND (f.strestat = 'A')) as atable
        LEFT OUTER JOIN
        (SELECT SUM(hs.stockbal) AS boh, hs.dmdctr, hs.dmdcomb FROM hospital.dbo.hdmhdrsub AS hs INNER JOIN hospital.dbo.hcharge AS hc ON hs.dmhdrsub = hc.chrgcode WHERE 
        (hs.statusMed = 'A') AND (hc.chrgcode = 'DRUM1') OR(hc.chrgcode = 'DRUM2') OR(hc.chrgcode = 'DRUM3') OR(hc.chrgcode = 'DRUMA') OR(hc.chrgcode = 'DRUMC') OR(hc.chrgcode = 'DRUMD') OR(hc.chrgcode = 'DRUME') OR(hc.chrgcode = 'DRUMF') OR(hc.chrgcode = 'DRUMG') OR(hc.chrgcode = 'DRUMH') OR(hc.chrgcode = 'DRUMI') OR(hc.chrgcode = 'DRUMK') OR(hc.chrgcode = 'DRUML') OR(hc.chrgcode = 'DRUMM') OR(hc.chrgcode = 'DRUMN') OR(hc.chrgcode = 'DRUMO') OR(hc.chrgcode = 'DRUM4')
        GROUP BY hs.dmdcomb, hs.dmdctr) as btable on atable.dmdctr = btable.dmdctr and atable.dmdcomb = btable.dmdcomb
        inner join procurement.dbo.dmds as ctable on atable.dmdcomb COLLATE DATABASE_DEFAULT = ctable.dmdcomb and atable.dmdctr = ctable.dmdctr) as tb6 on tb3.dmd_id = tb6.dmd_id
         WHERE tb5.purchase_order_id = '$id'");

        return response()->json($data);
    }
    public function update(Request $request, $id){
        

    }

    public function destroy($id){
        

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
    
    public function budget_rcv($id){

        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 6
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();

    }
    
    public function budget_rls($id){

        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 7
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);

        return response()->json();

    }
    
    public function cmps_rcv_po($id){
    
        $po = PurchaseOrder::findOrFail($id);

        $po->purchase_order_statuses()->create([
            'current_status_id' => 8
        ]);

        $po->update([
            'updated_at' => $this->date_now(),
        ]);
    
        return response()->json();
    }
    
    public function cmps_rls_po($id){
    
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
    
}
