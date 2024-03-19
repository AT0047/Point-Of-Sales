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
            $invoice = DB::table('dbo_invoicesanded')
            ->join('dbo_store', 'dbo_invoicesanded.Id', 'dbo_store.Store_Code')
            ->select('dbo_invoicesanded.InvoiceId',
            'dbo_invoicesanded.CreationDate',
            'dbo_store.Store_Name')
            ->where('dbo_store.Isdeleted', '=', 0)
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
