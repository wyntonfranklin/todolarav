<?php

namespace App\Http\Controllers;

class ProductsController
{


    // get all products
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
}
