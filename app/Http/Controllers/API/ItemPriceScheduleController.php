<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ItemPriceSchedule;
use App\Events\ItemPriceScheduleUpdated;

class ItemPriceScheduleController extends Controller
{
    public function index(){

    }

    public function store(Request $request, $id){
        $price_schedule_id = $id;
        $item_id = $request->item_id;

        $ips = ItemPriceSchedule::create([
                'price_schedule_id' => $id,
                'item_id' => $item_id,
                'supplier_id' => $request->supplier_id,
                'bid_price' => $request->bid_price,
                'manufacturer_id' => $request->manufacturer_id,
                'packaging_id' => $request->packaging_id,
                'brand_id' => $request->brand_id,
                'country_id' => $request->country_id,
        ]);

        $this->rank($item_id, $price_schedule_id);

        broadcast(new ItemPriceScheduleUpdated($ips));
        return response()->json($ips);
    }

    public function show($id){


    }

    public function update(Request $request, $id){
        $ips = ItemPriceSchedule::findOrfail($id);

        $ips->update([
            'supplier_id' => $request->supplier_id,
            'bid_price' => $request->bid_price,
            'manufacturer_id' => $request->manufacturer_id,
            'packaging_id' => $request->packaging_id,
            'brand_id' => $request->brand_id,
            'country_id' => $request->country_id,
        ]);

        $this->rank($ips->item_id, $ips->price_schedule_id);

        broadcast(new ItemPriceScheduleUpdated($ips));
        return response()->json($ips);
    }

    public function rank($item_id, $price_schedule_id){

        $array = ItemPriceSchedule::where('item_id', $item_id)->where('price_schedule_id', $price_schedule_id)->orderBy('bid_price', 'asc')->get();

        $count = count($array);
        $index = 0;
        
        if($count > 0){
            for($i = 0; $i < $count; $i++){
                $index++;
                $update_ips = ItemPriceSchedule::findOrFail($array[$i]->id);
                $update_ips->update([
                    'rank' => $index,
                ]);
            }
        }

        return $array;
    }

    public function terminate($id){
        $ips = ItemPriceSchedule::findOrFail($id);
        $ips->update([
            'terminated' => 1
        ]);

        broadcast(new ItemPriceScheduleUpdated($ips));

        return response()->json($ips);
    }

    public function unterminate($id){
        $ips = ItemPriceSchedule::findOrFail($id);
        $ips->update([
            'terminated' => 0
        ]);

        broadcast(new ItemPriceScheduleUpdated($ips));

        return response()->json($ips);
    }

    public function destroy($id){
        $ips = ItemPriceSchedule::where('id', $id)->first();
        $ips->delete();
        
        broadcast(new ItemPriceScheduleUpdated($ips));
        
        return response()->json($ips);
    }
}
