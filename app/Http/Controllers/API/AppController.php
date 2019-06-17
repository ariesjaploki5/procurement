<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\App;
use App\Events\AppCreated;
use App\Events\AppUpdated;
use App\Views\Dmds;

class AppController extends Controller
{

    public function index(){
        $apps = App::with([
            'category'
        ])->orderBy('app_year', 'desc')->get();

        return response()->json($apps);
    }

    public function store(Request $request){

        $app = App::create([
            'app_year' => $request->app_year,
            'app_budget' => $request->app_budget,
            'category_id' => $request->category_id,
        ]);
    
        broadcast(new AppCreated($app));

        return response()->json($app);
    }

    public function show($id){
        $app = App::findOrFail($id);
        $budget = $app->app_budget;
        return response()->json($budget);
    }

    public function update(Request $request, $id){
        $app = App::findOrFail($id);

        $app->update([
            'app_year' => $request->app_year,
            'app_budget' => $request->app_budget,
            'category_id' => $request->category_id,
        ]);

        broadcast(new AppUpdated($app));

        return response()->json($app);
    }

    public function destroy($id){
        $app = App::where('app_id', $id)->first();
        $app->delete();

        return response()->json();
    }
}
