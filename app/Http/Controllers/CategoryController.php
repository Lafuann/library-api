<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'data' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $data = $request->validate([
            'name' => ['required', 'string'],
            // 'release_year' => ['min:1980', 'max:2021', 'required']
        ]);
        Category::create($data);
        return response()->json(['message' => "Category created successfull!"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'data' => $category->books
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate(([
            'name' => ['string', 'nullable'],
        ]));
        if (!$data) {
            throw  new HttpResponseException(response()->json('Error validating data', 422));
        }
        try {
            $category->update($data);
            return response()->json(['message' => 'Category has been updated'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update'], 404);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'The category has been deleted']);
    }
}
