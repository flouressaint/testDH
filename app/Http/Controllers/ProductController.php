<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use App\Models\Products;
use Validator;
use Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');
        $minWeight = $request->query('min_weight');
        $maxWeight = $request->query('max_weight');
        $in_stock = $request->query('in_stock');

        $products = Products::query();
        if ($minPrice) {
            $products->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $products->where('price', '<=', $maxPrice);
        }
        if ($minWeight) {
            $products->where('weight', '>=', $minWeight);
        }
        if ($maxWeight) {
            $products->where('weight', '<=', $maxWeight);
        }
        if ($in_stock) {
            $products->where('in_stock', $in_stock);
        }

        $products = $products->orderBy("id")->paginate(10);
        return Response::json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'in_stock' => 'required',
            'weight' => 'required'
        ]);

        if ($validator->fails()) {
            return Response::json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $product = Products::create($validated);
        return response(json_encode([
            "product_id" => $product->id
        ]), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Products::findOrFail($id);
        $reviews = Reviews::query()->where("product_id", $product->id)->get();
        $product->reviews = $reviews;
        return response($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'in_stock' => 'required',
            'weight' => 'required'
        ]);

        if ($validator->fails()) {
            return Response::json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $product = Products::findOrFail($id)->update($validated);
        return response(json_encode([
            "message" => "product updated"
        ]), 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return Response::json(["message" => "product deleted"], 200);
    }
}
