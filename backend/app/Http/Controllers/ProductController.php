<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show all products
    }

    public function show(Product $product)
    {
        //product details per id
    }
}
