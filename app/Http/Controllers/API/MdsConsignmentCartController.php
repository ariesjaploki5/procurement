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

    public function search_patient(Request $request){

        $data = DB::table('hospital.dbo.hperson')
        ->where('hpercode', 'like', "%$request->hospnumber")
        ->where('patlast', 'like', "%$request->patlast%")
        ->where('patfirst', 'like', "%$request->patfirst%")
        ->where('patmiddle', 'like', "%$request->patmiddle%")
        ->orderBy('patlast', 'asc')
        ->orderBy('patfirst', 'asc')
        ->orderBy('patmiddle', 'asc')
        ->get();

        return response()->json($data);

    }

    public function select_enccode(Request $request){

        $data = DB::SELECT("SELECT * FROM hospital.les.allencounters ('$request->hospnumber')  order by admdate desc");
        return response()->json($data);

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
            'enccode' => $request->enccode,
            'hpercode' => $request->hpercode,
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

        $cr_id = $cr->crID;

        return response()->json($cr_id);
    }

    public function destroy(){

        $cart = MdsConsignmentCart::truncate();
        return response()->json();

    }
}
