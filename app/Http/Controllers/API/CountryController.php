<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class CountryController extends Controller
{

    public function index(){
        $data = Country::orderBy('country_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $country = Country::create([
            'country_desc' => $request->country_desc,
        ]);

        return response()->json($country);
    }

    public function show($id){
        

    }

    public function update(Request $request, $id){
        $country = Country::findOrFail($id);
        $country->update([
            'country_desc' => $request->country_desc,
        ]);

        return response()->json($country);
    }

    public function destroy($id){
        $country = Country::where('country_id', $id)->first();
        $country->delete();

        return response()->json($country);
    }
}
