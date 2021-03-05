<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class SaleController extends Controller
{
   public function productSales(Request $request){
        $product = Product::find($request->get("product_id"));
        if (!$product) {
            return response()->json([
                "message" => "No se encontro el Id del producto."
            ], 404); 
        }else{
            $sale = new Sale;
            $sale->product_id = $request->get("product_id");
            $sale->amount = $request->get('amount');
            $sale->unit_value = $product->price;
            $sale->client = $request->get('client');
            $sale->phone = $request->get('phone');
            $sale->email = $request->get('email');
            $sale->save();

            return response()->json([
                "message" => "Sale created",
                "sale" => $sale
            ], 201);
        }
   }
}
