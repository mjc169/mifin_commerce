<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // For database transactions
use App\Models;
use App\Services\CheckoutService;

class OrderController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout(Request $request)
    {
        try {
            $orderId = $this->checkoutService->processCheckout($request->user());

            return response()->json([
                'message' => 'Order placed successfully',
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to place order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
