<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Employee;
use App\User;
use DB;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    public function error()
    {
        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function login(Request $request)
    {
        $credentials = request(['username', 'password']);

        $username = $request->username;
        $password = $request->password;

        

        $select = DB::select("Select top 1 employeeid from hospital.dbo.user_acc where user_name = '$username' and user_pass = webapp.dbo.ufn_crypto('$password',1)");

        $user_account = $select[0]->employeeid;

        $employee = Employee::where('employeeid', $user_account)->select('firstname', 'lastname', 'middlename', 'employeeid')->first();

        $emp_id = $employee->employeeid;

        $user = User::where('employee_id', $emp_id)->first();

        if($user === null){
            $new = new User;
            $new->username = $username;
            $new->password = Hash::make($password);
            $new->employee_id = $emp_id;
            $new->role_id = 1;
            $new->save();
        }

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }
 
    public function logout()
    {
        auth('api')->logout();
        
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 1892160000
            ]);
    }

    public function guard() {
        return \Auth::Guard('api');
    }

}
