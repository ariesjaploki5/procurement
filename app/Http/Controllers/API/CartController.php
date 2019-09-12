<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDmd;
use App\Views\Carts;
use DB;
use Carbon\Carbon;
use App\Views\NewCart;

class CartController extends Controller
{

    public function index(){
        $data = Cart::orderBy('created_at', 'desc')->get();

        return response()->json($data);
    }

    public function store(Request $request){

        return response()->json();
    }



    public function add_dmd(Request $request, $user_id){
        $mode_id = $request->mode_id;
       
        $cart = Cart::firstOrCreate([ 
            'user_id' => $user_id, 
            'mode_id' => $mode_id,
            'status' => 0 ,
        ]);
        
        // if(!CartDmd::where('cart_id', $cart->id)->where('dmd_id', $request->dmd_id)->exists()){
        //     $cart->dmds()->attach($request->dmd_id);
            
        
        // }

        $cart_dmd = CartDmd::firstOrCreate([
            'cart_id' => $cart->id,
            'dmd_id' => $request->dmd_id,
        ]);
        
        return response()->json($mode_id);
    }

    public function add_dmd_2(Request $request, $user_id){
        $mode_id = $request->mode_id;

        $cart = Cart::firstOrCreate([
            'user_id' => $user_id,
            'mode_id' => $mode_id,
            'status' => 0
        ]);

        // if(!CartDmd::where('cart_id', $cart->id)->where('dmd_id', $request->dmd_id)->exists()){
        //     $cart->dmds()->attach($request->dmd_id);
        // }

        $cart_dmd = CartDmd::firstOrCreate([
            'cart_id' => $cart->id,
            'dmd_id' => $request->dmd_id,
        ]);
        
        return response()->json($mode_id);
    }

    public function add_dmd_3(Request $request, $id){

        $cart = Cart::firstOrCreate([
            'user_id' => $user_id,
            'status' => 0,
        ]);

        if(!CartDmd::where('cart_id', $cart->id)->where('dmd_id', $request->dmd_id)->exists()){
            $cart->dmds()->attach($request->dmd_id);
        }

        return response()->json($cart);
    }

    public function remove_dmd($id){

        $cart_dmd = CartDmd::where('id', $id)->first();
        
        $cart_dmd->delete();

        return response()->json($cart_dmd);

    }

    public function show($id){


    }


    public function shopping(){
        
        // $data = NewCart::where('status', 0)
        // ->where('mode_id', 4)
        // ->where('app_year', Carbon::now()->year)
        // ->orderBy('dmddesc', 'asc')
        // ->get();

        // $data = Cart::with([
        //     'cart_dmds' => function($query){
        //         $query->with([
        //             'app_dmd_year'
        //         ]);
        //     }
        // ])
        // ->where('mode_id',4)
        // ->where('status', 0)
        // ->first();

        $data = DB::SELECT("SELECT * FROM procurement.dbo.fn_cart_shopping()");

        return response()->json($data);
    }

    public function public_bidding(){
        
        // $data = Cart::with([
        //     'cart_dmds' => function($query){
        //         $query->with([
        //             'dmd_price_schedule', 
        //             'app_dmd_year',
        //         ]);
        //     }
        // ])
        // ->where('mode_id', 1)
        // ->where('status', 0)
        // ->first();

        $data = DB::SELECT("SELECT * FROM procurement.dbo.fn_cart_public_bidding()");

        return response()->json($data);
    }

    public function year_now(){
        $now = Carbon::now();
        $year = $now->year;

        return $year;
    }

    public function pr_items(){
        
        $data = Carts::with([
            'dmd_price_schedule', 'app_dmd'
            ])->where('app_year', $this->year_now())
            ->where('status', 0)
            ->orderBy('gendesc', 'asc')
            ->get();

        return response()->json($data);
    }

    public function update(Request $request, $id){


    }

    public function destroy($id){
        $data = Cart::truncate();

        return response()->json();
    }
}
