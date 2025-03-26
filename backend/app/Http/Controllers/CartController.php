<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Services;

class CartController extends Controller
{
    protected Services\CartService $cartService;

    public function __construct(Services\CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function getCart(Request $request)
    {
        $user = $request->user();
        $cart = Models\Cart::firstOrCreate(['user_id' => $user->id]);
        $cartItems = $cart->cartItems()->with('product')->get();
        return response()->json(['cart' => $cart, 'cartItems' => $cartItems]);
    }

    public function addToCart(Request $request, string $id)
    {
        try {
            $cartItem = $this->cartService->addProductToCart($request->user(), $id, $request->input('quantity', 1));
            return response()->json(['cartItem' => $cartItem]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function removeToCart(Request $request, string $id)
    {
        try {
            $cartItem = $this->cartService->removeProductToCart($request->user(), $id);
            return response()->json(['message' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
