<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'password' => 'required',
            'Branch_Id' => 'required',
        ];
        $validate = Validator::make(request()->all(), $rules);
        $user = User::where('users.Isdeleted', 0)->where('User_Name', $request->name)->where('UserPassword', $request->password)->first();
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }
        if (!$user) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => 'no user '], 422);
        }
        
        $data = DB::table('users')
            ->where('users.Isdeleted', 0)
            ->join('UserBranches', 'users.Code', 'UserBranches.UserCode')
            ->where('userBranches.Isdeleted', '=', 0)
            ->where('userBranches.BranchId', '=', 1)
            ->select('users.Code', 'users.User_Name', 'users.UserPassword', 'users.DefaultMandoobCode', 'users.DefaultCashBooksCode', 'Users.DefaultBankCode', 'Users.DefaultStoreCode')
            ->get();
            return response($user, 200);
    }
    
    public function code(Request $request)
    {
        $rules = [
            'code' => 'required|string',
        ];
        $validate = Validator::make(request()->all(), $rules);
        $user = User::where('users.Isdeleted', 0)->where('User_Code', $request->code)->first();
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }
        if (!$user) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => 'no user '], 422);
        }
        return response($user, 200);
    }
}
