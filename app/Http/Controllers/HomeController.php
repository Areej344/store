<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Retrieve categories and products from the database
        $categories = Category::all();
        $products = Product::limit(10)->get(); // Display 6 featured products for now

        // Return the home page view with categories and products data
        return view('home', compact('categories', 'products'));
    }
}
