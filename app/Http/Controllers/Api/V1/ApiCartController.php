<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Enums\CartStatusEnum;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ApiCartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return $cart->load('items')->toResource();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Validate the specified resource in storage.
     */
    public function validate()
    {
        $cart = auth()->user()->cart->load('items.product');

        Gate::authorize('validate', $cart);

        DB::transaction(function () use ($cart) {
            $this->cartService->decrementStock($cart);

            $cart->update(['status' => CartStatusEnum::VALIDATED]);
        });

        return $cart->toResource();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
