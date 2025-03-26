<?php

namespace App\Services;

use App\Models;
use Exception;

class CartService
{
    public function getUserCart(Models\User $user): ?Models\Cart
    {
        $cart = Models\Cart::query()->where(['user_id' => $user->id])->first();
        if ($cart) {
            $cart->load('cartItems', 'cartItems.product');
        }
        return $cart;
    }

    public function addProductToCart(Models\User $user, string $productId, int $quantity = 1): Models\CartItem
    {
        $product = Models\Product::find($productId);

        if (!$product) {
            throw new Exception('Product not found', 404);
        }

        $cart = Models\Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = Models\CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if (!$cartItem) {
            $cartItem = new Models\CartItem;
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $product->id;
        }

        $cartItem->quantity = $quantity;
        $cartItem->save();

        return $cartItem;
    }

    public function removeProductToCart(Models\User $user, string $productId): void
    {
        $product = Models\Product::find($productId);

        if (!$product) {
            throw new Exception('Product not found', 404);
        }

        $cart = Models\Cart::firstOrCreate(['user_id' => $user->id]);

        Models\CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->delete();
    }

    public function calculateCartTotal(Models\Cart $cart): float
    {
        return $cart->cartItems->sum(function (Models\CartItem $cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });
    }

    public function validateCartTotalAmount(float $totalAmount)
    {
        //cart total
        if (!$this->isTotalPriceSupported($totalAmount)) {
            throw new Exception('Cart\'s total amount is too large to handle', 413);
        }
    }

    public function validateCartItems(Models\Cart $cart)
    {
        foreach ($cart->cartItems as $cartItem) {
            $subTotal = $cartItem->quantity * $cartItem->product->price;
            if (!$this->isTotalPriceSupported($subTotal)) {
                throw new Exception('Product ordered amount is too large to handle', 413);
            }
        }
    }

    public function clearCart(Models\Cart $cart)
    {
        $cart->cartItems()->delete();
        $cart->delete();
    }

    public function isTotalPriceSupported(float $total): bool
    {
        $maxValue = 99999999.99;
        return $total <= $maxValue;
    }
}
