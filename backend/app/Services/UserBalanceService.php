<?php

namespace App\Services;

use App\Models;
use Exception;

class UserBalanceService
{
    public function validateBalance(Models\User $user, float $totalAmount)
    {
        if (!$this->hasEnoughBalance($user, $totalAmount)) {
            throw new Exception('Unable to proceed, balance is not enough.', 402);
        }
    }

    public function deductBalance(Models\User $user, float $totalAmount)
    {
        $user->balance -= $totalAmount;
        $user->save();
    }

    private function hasEnoughBalance(Models\User $user, float $totalAmount): bool
    {
        return $user->balance >= $totalAmount;
    }
}
