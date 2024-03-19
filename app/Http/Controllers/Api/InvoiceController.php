<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function invoiceIndex(){
        try{
            $invoice = DB::table('invoice')
            ->join('store', 'invoice.Id', 'store.Store_Code')
            ->select(
            'invoice.InvoiceId',
            'invoice.CreationDate',
            'store.Store_Name')
            ->where('store.Isdeleted', '=', 0)
            ->get();
            if ($invoice->isEmpty()) {
                return response()->json([
                'status' => 'No Data Available...',
            ]);
        }
            return response()->json($invoice);
        }catch(Exception $e){
            return response()->json([
                'status' => 'Failure',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
