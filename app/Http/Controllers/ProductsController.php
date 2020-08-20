<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display and manage the products
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('products');
    }
}
