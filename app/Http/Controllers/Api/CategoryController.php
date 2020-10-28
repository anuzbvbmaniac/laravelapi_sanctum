<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller {

    public function index() {
        // $categories = Category::select('id', 'name')->get(); //select selects only defined column.
        $categories = Category::all(); // Resource handel set of rules of what field are to be returned.

        return CategoryResource::collection($categories); // Set of rules of what field are to be returned.
    }

    public function show(Category $category) {
        // return $category; //route model binding
        return new CategoryResource($category); // Get Specified Parameters only from Resource.
    }

    public function store(StoreCategoryRequest $request) {
        $category = Category::create($request->all());

        return new CategoryResource($category);
    }

    public function update(Category $category, StoreCategoryRequest $request) {
        $category->update($request->all()); // Send _method = PUT inside body.

        return new CategoryResource($category);
    }

    public function destroy(Category $category) {
        $category->delete(); // Send _method = DELETE inside body.

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
