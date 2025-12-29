<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;

class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::withCount('articles')->orderBy('name')->get();

        return $products->toResourceCollection();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Gate::authorize('create', Product::class);

        $product = new Product;

        $product->fill($request->validated());

        $product->save();

        $product->refresh();

        return $product->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        Gate::authorize('update', $product);

        $product->fill($request->validated());

        $product->save();

        $product->refresh();

        return $product->toResource();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product->loadCount('articles'));

        $product->delete();

        return $product->toResource();

    }
}
