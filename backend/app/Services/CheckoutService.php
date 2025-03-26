<?php

namespace App\Services;

use App\Models;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutService
{
    protected UserBalanceService $userBalanceService;
    protected CartService $cartService;
    protected OrderService $orderService;

    public function __construct(UserBalanceService $userBalanceService, CartService $cartService, OrderService $orderService)
    {
        $this->userBalanceService = $userBalanceService;
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    public function processCheckout(Models\User $user, array $addressData): Models\Order
    {
        $cart = $this->cartService->getUserCart($user);

        if (!$cart) {
            throw new Exception('Cart is empty', 400);
        }

        $totalAmount = $this->cartService->calculateCartTotal($cart);
        $this->cartService->validateCartTotalAmount($totalAmount);

        $this->userBalanceService->validateBalance($user, $totalAmount);
        $this->cartService->validateCartItems($cart);

        DB::beginTransaction();

        try {
            $order = $this->orderService->createOrder($user, $totalAmount, $cart, $addressData);

            $this->userBalanceService->deductBalance($user, $totalAmount);
            $this->cartService->clearCart($cart);

            DB::commit();

            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
