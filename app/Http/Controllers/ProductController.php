<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request): ProductResource
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }
        $product = Product::create($data);
        $product['user_id'] = Auth::user()->id;
        $product->save();
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id)->first();
        if (!$product) {
            return new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "Product not found"
                    ]
                ]
            ]));
        }
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, $id): ProductResource
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }
        $product = Product::find($id)->first();
        $product->update($data);
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "Product not found"
                    ]
                ]
            ], 404));
        }
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
