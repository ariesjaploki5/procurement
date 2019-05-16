<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EndUser;

class EndUserController extends Controller
{

    public function index(){
        $end_user = EndUser::order_by('end_user_name')->get();

        return response()->json($end_user);
    }

    public function store(Request $request){
        $end_user = EndUser::create([
            'end_user_name' => $request->end_user_name,
        ]);

        return response()->json($end_user);
    }

    public function show($id){
        

    }

    public function update(Request $request, $id){
        $end_user = EndUser::findOrFail($id);
        $end_user->update([
            'end_user_name' => $request->end_user_name,
        ]);

        return response()->json($end_user);
    }

    public function destroy($id){
        $end_user = EndUser::where('end_user_id', $id)->first();
        $end_user->delete();

        return response()->json($end_user);
    }
}
