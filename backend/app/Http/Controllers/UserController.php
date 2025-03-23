<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function getUserInformation(Request $request)
    {
        return $request->user();
    }
}
