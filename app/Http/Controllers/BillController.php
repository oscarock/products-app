<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Sale;


class BillController extends Controller
{
    public function generateBill(Request $request){
        $sales = Sale::find($request->get("sale_id"));
        if (!$sales) {
            return response()->json([
                "message" => "No se encontro el Id de la venta."
            ], 404); 
        }else{
            $bill = new Bill;
            $bill->sale_id = $request->get("sale_id");
            $bill->iva = $request->get('iva');
            $bill->sub_total = $sales->unit_value;

            $ivaTotal = $sales->unit_value * $request->get('iva') / 100;
            $bill->total = $sales->unit_value + $ivaTotal;
            $bill->save();

            return response()->json([
                "message" => "Bill created",
                "bill" => $bill
            ], 201);
        }
    }
}
