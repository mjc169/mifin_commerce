<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;
use App\Services\CheckoutService;
use App\Services\CartService;
use App\Services\EmailService;


class OrderController extends Controller
{
    protected $checkoutService;
    protected $cartService;
    protected $emailService;

    public function __construct(CheckoutService $checkoutService, CartService $cartService, EmailService $emailService)
    {
        $this->checkoutService = $checkoutService;
        $this->cartService = $cartService;
        $this->emailService = $emailService;
    }

    public function checkout(Request $request)
    {
        $cart = $this->cartService->getUserCart($request->user());

        if (!$cart) {
            throw new \Exception('Cart is empty', 400);
        }

        try {
            $order = $this->checkoutService->processCheckout($request->user());
            $config = $this->getOrderInformation($order);
            $this->emailService->sendMail($config);

            return response()->json([
                'message' => 'Order placed successfully',
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to place order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function getOrderInformation(Models\Order $order)
    {
        $orderItems = $order->orderDetails->map(function (Models\OrderDetail $orderDetail) {
            return [
                'product_name' => $orderDetail->product_name,
                'product_price' => $orderDetail->product_price,
                'quantity' => $orderDetail->quantity,
                'subtotal' => $orderDetail->quantity * $orderDetail->product_price,
            ];
        });

        return [
            'orderId' => $order->id,
            'customerName' => $order->user->name,
            'sendTo' => $order->user->email,
            'totalAmount' => number_format($order->total_amount, 2),
            'address' => $order->address,
            'city' => $order->city,
            'state' => $order->state,
            'zip' => $order->zip,
            'items' => $orderItems,
            'thankYouMessage' => 'Thank you for your order!',
        ];
    }
}
