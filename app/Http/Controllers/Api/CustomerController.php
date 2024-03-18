<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function storeNewUser(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'business_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'taxCardNo' => 'required',
        ];

        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }
        $last = DB::table("ne_cust")->orderBy("Id",'desc')->first();
        DB::table("ne_cust")->insert([
            'Id'=>$last?((int)$last->Id)+1:1,
            'CName'=>$request->name,
            'CoName'=>$request->business_name,
            'Tel1'=>$request->phone,
            'Address1'=>$request->address,
            'TaxCardNo'=>$request->taxCardNo,
        ]);
        return response("تم بنجاح");
    }//end fun


    public function getSettings(Request $request)
    {
       $row = DB::table('settings')
           ->select(
               'facebook', 'twitter', 'instagram', 'linkedin', 'telegram', 'youtube',
               'google_plus', 'snapchat_ghost', 'whatsapp', 'ar_about_app', 'en_about_app', 'ar_terms_condition',
               'en_terms_condition', 'ar_privacy_policy', 'en_privacy_policy'
           )
           ->latest()
           ->first();
        return response()->json($row,200);
    }


    public function saveContactForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }

        $data = $validator->validated();
        $data['is_read'] = 'un_read';

         DB::table("contacts")->insert($data);
        return response('تم حفظ نموذج الاتصال بنجاح');
    }//end fun

}//end class
