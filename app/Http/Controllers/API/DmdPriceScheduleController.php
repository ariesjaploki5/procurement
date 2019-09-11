<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DmdPriceSchedule;
use App\Events\DmdPriceScheduleUpdated;

class DmdPriceScheduleController extends Controller
{
    public function index(){

    }

    public function store(Request $request, $id){
        $price_schedule_id = $id;
        $dmd_id = $request->dmd_id;

        $ips = DmdPriceSchedule::create([
                'price_schedule_id' => $id,
                'dmd_id' => $dmd_id,
                'supplier_id' => $request->supplier_id,
                'bid_price' => $request->bid_price,
                'manufacturer_id' => $request->manufacturer_id,
                'packaging_id' => $request->packaging_id,
                'brand_id' => $request->brand_id,
                'country_id' => $request->country_id,
        ]);

        $this->rank($dmd_id, $price_schedule_id);

        return response()->json($ips);
    }

    public function show($id){


    }

    public function update(Request $request, $id){
        $ips = DmdPriceSchedule::findOrfail($id);

        $ips->update([
            'supplier_id' => $request->supplier_id,
            'bid_price' => $request->bid_price,
            'manufacturer_id' => $request->manufacturer_id,
            'packaging_id' => $request->packaging_id,
            'brand_id' => $request->brand_id,
            'country_id' => $request->country_id,
        ]);

        $this->rank($ips->dmd_id, $ips->price_schedule_id);

        return response()->json($ips);
    }

    public function rank($dmd_id, $price_schedule_id){
        $array = DmdPriceSchedule::where('dmd_id', $dmd_id)->where('price_schedule_id', $price_schedule_id)->orderBy('bid_price', 'asc')->get();

        $count = count($array);
        $index = 0;
        
        if($count > 0){
            for($i = 0; $i < $count; $i++){
                $index++;
                $update_ips = DmdPriceSchedule::findOrFail($array[$i]->id);
                $update_ips->update([
                    'rank' => $index,
                ]);
            }
        }

        return $array;
    }

    public function terminate($id){
        $ips = DmdPriceSchedule::findOrFail($id);
        $ips->update([
            'terminated' => 1
        ]);

        return response()->json($ips);
    }

    public function unterminate($id){
        $ips = DmdPriceSchedule::findOrFail($id);
        $ips->update([
            'terminated' => 0
        ]);

        return response()->json($ips);
    }

    public function destroy($id){
        $ips = DmdPriceSchedule::where('id', $id)->first();
        $ips->delete();
        
        return response()->json($ips);
    }
}
