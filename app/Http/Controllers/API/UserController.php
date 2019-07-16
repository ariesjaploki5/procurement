<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data = User::orderBy('username', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return response()->json();
    }

    public function update(Request $request, $id){

        $user = User::findOrFail($id);

        if(Hash::check($request->old_password, $user->password)){
            $user->update([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);
        }

        return response()->json();
    }


    public function show($id){
        $user = User::with([
            'employee'
        ])->where('user_id', $id)->first();

        return response()->json($user);
    }

    public function destroy($id){
        $user = User::where('user_id', $id)->first();
        $user->delete();
        
        return response()->json();
    }
}
