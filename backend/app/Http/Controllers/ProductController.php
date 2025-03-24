<?php

namespace App\Http\Controllers;

use App\Models;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Models\Product::all();
    }

    public function show(Models\Product $product)
    {
        //product details per id
    }
}
