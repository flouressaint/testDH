<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Response;
use Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id, Request $request)
    {

        $validator = Validator::make($request->all(), [
                    'customer' => 'required',
                    'review' => 'required',
                ]);

        if ($validator->fails()) {
            return Response::json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $review = new Reviews();
        $review->product_id = $id;
        $review->customer = $request->customer;
        $review->review = $request->review;
        $review->save();
        return response(json_encode([
            "review_id" => $review->id
        ]), 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
