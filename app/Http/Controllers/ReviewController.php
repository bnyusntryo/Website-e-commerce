<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();

        return response()->json([
            'data'=> $reviews
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            "id_member" => 'required',
            "id_produk" => 'required',
            "review" => 'required',
            "rating" => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(), 
                422
            );
        }

        $input = $request->all();

        $Review = Review::create($input);

        return response()->json([
            'data' => $Review
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $Review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $Review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $Review)
    {

        $validator = Validator::make($request->all(),[
            "id_member" => 'required',
            "id_produk" => 'required',
            "review" => 'required',
            "rating" => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(), 
                422
            );
        }

        $input = $request->all();

        $Review->update($input);

        return response()->json([
            'message' => 'success',
            'data' => $Review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $Review)
    {
        $Review->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
