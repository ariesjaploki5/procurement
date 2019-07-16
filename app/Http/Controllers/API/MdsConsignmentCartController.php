<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MdsConsignmentCart;
use App\Models\MdsConsignmentDetails;
use App\Models\ConsignmentRequest;
use DB;
use Carbon\Carbon;


class MdsConsignmentCartController extends Controller
{
    public function index(){
        // $cart = MdsConsignmentCart::all();

        $cart = DB::SELECT("SELECT * FROM procurement.dbo.mds_c_cart as tb1 
        INNER JOIN hospital.les.vwMedicalSuppliesConsignmentItems as tb2 
        on tb1.cl2comb COLLATE DATABASE_DEFAULT = tb2.cl2comb and tb1.costprc = tb2.costprc");

        return response()->json($cart);
    }

    public function store(Request $request, $cl2comb, $costprc){
        $cart = MdsConsignmentCart::firstOrCreate(
            ['cl2comb' => $cl2comb, 'costprc' => $costprc]
        );


        return response()->json();
    }

    public function crID(){
        return Carbon::today()->format('dmY');
    }

    public function date_time(){
        return Carbon::now();
    }

    public function submit_cart(Request $request){

        $item = $request->items;
        $count = count($item);

        $cr = ConsignmentRequest::create([
            'crDate' => $this->date_time(),
            'purpose' => $request->purpose,
            'entryby' => $request->employee_id,
        ]);

        $cr->crID = 'ENTHN'.''.$this->crID().''.$cr->id;
        $cr->save();
        
        for($i = 0; $i < $count; $i++){
            MdsConsignmentDetails::create([
                'crID' => $cr->crID,
                'itemcode' => $item[$i]['cl2comb'],
                'itemPrice' => $item[$i]['costprc'],
                'itemQty' =>$item[$i]['itemQty'],
                'itemStat' => 'A',
                'tStamp' => $this->date_time(),
            ]);
        }

        $this->destroy();

        return response()->json();
    }

    public function destroy(){

        $cart = MdsConsignmentCart::truncate();
        return response()->json();

    }
}
