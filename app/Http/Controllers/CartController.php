<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Loyalty;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cartItems = Session::get('cart', []);
        return view('cart.index', compact('cartItems'));
    }

    /**
     * Add a product to the cart and apply loyalty discounts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    
        // Find the product
        $product = Product::find($request->product_id);
    
        // Calculate the discount based on loyalty points
        $discountPercentage = floor($product->points / 10) * 5; // 5% for every 10 points
        $discountAmount = ($product->price * $discountPercentage) / 100;
        $finalPrice = $product->price - $discountAmount;
    
        // Add product to the cart (stored in session)
        $cart = Session::get('cart', []);
    
        if (isset($cart[$product->id])) {
            // If the product already exists in the cart, update the quantity
            $cart[$product->id]['quantity'] += 1;
        } else {
            // Add new product to the cart
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price, // Original price
                'quantity' => 1,
                'attributes' => [
                    'points' => $product->points,
                    'discount' => $discountAmount,
                    'final_price' => $finalPrice,
                ],
            ];
        }
    
        // Save the updated cart back to the session
        Session::put('cart', $cart);
    
        return redirect()->back()->with('success', 'Product added to cart with loyalty discount!');
    }

    /**
     * Display the cart with loyalty discounts applied.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showCart()
    {
        $cartItems = Session::get('cart', []); // Get cart items from session

        // Calculate total price and points
        $totalPrice = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $totalPoints = collect($cartItems)->sum(function ($item) {
            return ($item['attributes']['points'] ?? 0) * $item['quantity'];
        });

        // Calculate discount based on total points (5% for every 10 points)
        $discountPercentage = floor($totalPoints / 10) * 5;
        $discountAmount = ($totalPrice * $discountPercentage) / 100;
        $finalPrice = $totalPrice - $discountAmount;

        // Pass data to the view
        return view('partials.cart-items', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'discountAmount' => $discountAmount,
            'discountPercentage' => $discountPercentage,
            'finalPrice' => $finalPrice,
        ]);
    }

    /**
     * Remove a product from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
   // app/Http/Controllers/CartController.php
public function removeFromCart(Request $request, $id)
{
    // Get the current cart from the session
    $cart = Session::get('cart', []);

    // Remove the product from the cart
    if (isset($cart[$id])) {
        unset($cart[$id]);
        Session::put('cart', $cart);
    }

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Product removed from cart successfully!');
}

    /**
     * Checkout and process the order.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkout()
    {
        $cartItems = Session::get('cart', []);

        // Create a new order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => collect($cartItems)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            }),
        ]);

        // Attach products to the order
        foreach ($cartItems as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'points' => $item['attributes']['points'],
                'discount' => $item['attributes']['discount'],
                'final_price' => $item['attributes']['final_price'],
            ]);
        }

        // Clear the cart
        Session::forget('cart');

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }
}