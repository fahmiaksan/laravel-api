<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return CategoryResource::collection($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request): CategoryResource
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        $category = Category::create($data);

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): CategoryResource
    {
        $category = Category::find($id);
        if (!$category) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "category not found"
                    ]
                ]
            ], 404));
        }
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $category = Category::find($id);

        if (!$category) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "category not found"
                    ]
                ]
            ], 404));
        }

        if (isset($data['image']) && $request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        $category->update($data);
        return response()->json([
            'message' => 'Category updated successfully',
            'category' => new CategoryResource($category)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $category = Category::find($id);
        if (!$category) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "category not found"
                    ]
                ]
            ], 404));
        }

        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}
