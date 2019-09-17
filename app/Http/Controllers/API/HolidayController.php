<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Carbon\Carbon;

class HolidayController extends Controller
{
    public function index(){
        $data = Holiday::whereYear('holiday_date', date(Carbon::now()->year))->orderBy('holiday_date', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $holiday = Holiday::firstOrCreate([
            'holiday_date' => $request->holiday_date,
        ], [
            'holiday_name' => $request->holiday_name,
        ]);

        return response()->json();
    }

    public function update(Request $request, $id){
        $holiday = Holiday::findOrFail($id);
        $holiday->update([
            'holiday_date' => $request->holiday_date,
            'holiday_name' => $request->holiday_name
        ]);

        return response()->json();
    }

    public function destroy($id){
        $holiday = Holiday::where('holiday_id', $id)->first();
        $holiday->delete();

        return response()-json();
    }
}
