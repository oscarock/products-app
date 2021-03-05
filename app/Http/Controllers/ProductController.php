<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $product = new Product;
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->photo = $request->get('photo');
            $product->price = $request->get('price');
            $product->save();

            return response()->json([
                "message" => "Product created",
                "product" => $product
            ], 201);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "message" => "No se encontro el Id."
            ], 404); 
        }else{
            $validator = Validator::make($request->all(), [ 
                'name' => 'required',
                'description' => 'required',
                'photo' => 'required',
                'price' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }else{
                $product->update($request->all());
                return response()->json([
                    "message" => "Edited product",
                    "product" => $product
                ], 201);
            }  
        } 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "message" => "No se encontro el Id."
            ], 404); 
        }else{
            $product->delete();
        }

        return response()->json([
            "message" => "product removed",
            "product" => $product
        ], 201);
    }
}
