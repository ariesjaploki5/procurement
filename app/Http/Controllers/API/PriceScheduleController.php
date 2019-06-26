<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PriceSchedule;
use App\Models\Item;
use App\Models\ItemPriceSchedule;
use App\Views\Dmds;
use App\Models\DmdPriceSchedule;

use App\Events\PriceScheduleCreated;
use App\Events\PriceScheduleUpdated;
use App\Events\ItemPriceScheduleUpdated;
use Carbon\Carbon;

class PriceScheduleController extends Controller
{

    public function index(){
        $data = PriceSchedule::with([
                    'created_by.employee', 'category'
                ])->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $ps = PriceSchedule::create([
            'category_id' => $request->category_id,
            'price_schedule_year' => $request->price_schedule_year,
            'user_id' => $request->user_id,
        ]);

        return response()->json($ps);
    }

    // public function show($id){
    //     $data = Item::with([
    //             'item_price_schedules' => function($query) use ($id){
    //                 $query->with(['brand', 'manufacturer', 'packaging', 'supplier', 'country'
    //                 ])->where('price_schedule_id', $id)->orderBy('rank', 'asc');
    //             },
    //         ])->get();
    //     return response()->json($data);
    // }

    public function show($id){
        $year = Carbon::now()->year;

        $data = Dmds::with([
                'dmd_price_schedules' => function($query) use ($id){
                    $query->with([
                        'brand', 
                        'packaging', 
                        'supplier', 
                        'country',
                    ])->where('price_schedule_id', $id)->orderBy('rank', 'asc');
                }, 'app_dmd',
            ])->orderBy('gendesc', 'asc')->get();
        return response()->json($data);
    }

    

    public function update(Request $request, $id){
        $ps = PriceSchedule::findOrFail($id);

        $ps->update([
            'category_id' => $request->category_id,
            'price_schedule_year' => $request->price_schedule_year,
            'user_id' => $request->user_id,
        ]);

        return response()->json($ps);
    }

    public function destroy($id){
        $ps = PriceSchedule::where('price_schedule_id', $id)->first();
        $ps->delete();

        return response()->json($ps);
    }

    public function price_schedule_get($id){
        $ps = PriceSchedule::with([
            'category'
        ])->where('price_schedule_id', $id)->first();

        return response()->json($ps);
    }   
    
}
