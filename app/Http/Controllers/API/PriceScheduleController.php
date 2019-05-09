<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PriceSchedule;
use App\Events\PriceScheduleCreated;
use App\Events\PriceScheduleUpdated;

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

        broadcast(new PriceScheduleCreated($ps));


        return response()->json($ps);
    }

    public function show($id){
        

    }

    public function update(Request $request, $id){
        $ps = PriceSchedule::findOrFail($id);

        $ps->update([
            'category_id' => $request->category_id,
            'price_schedule_year' => $request->price_schedule_year,
            'user_id' => $request->user_id,
        ]);

        broadcast(new PriceScheduleUpdated($ps));

        return response()->json($ps);
    }

    public function destroy($id){
        

    }
}
