<?php

namespace App\Services;

use App\Models;

class OrderService
{
    public function createOrder(Models\User $user, $totalAmount, Models\Cart $cart): Models\Order
    {
        $order = new Models\Order;
        $order->user_id = $user->id;
        $order->total_amount = $totalAmount;
        $order->save();

        foreach ($cart->cartItems as $cartItem) {
            $orderDetail = new Models\OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartItem->product_id;
            $orderDetail->product_name = $cartItem->product->name;
            $orderDetail->product_price = $cartItem->product->price;
            $orderDetail->quantity = $cartItem->quantity;
            $orderDetail->total = $cartItem->quantity * $cartItem->product->price;
            $orderDetail->save();
        }

        return $order;
    }
}
