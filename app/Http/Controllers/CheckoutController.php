<?php

// app/Http/Controllers/CheckoutController.php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Display the checkout page
    public function index()
    {
        // Get the cart items (example: using session)
        $cart = session()->get('cart', []);

        // Calculate totals
        $totalFinalPrice = 0;
        foreach ($cart as $item) {
            $totalFinalPrice += $item['attributes']['final_price'] * $item['quantity'];
        }

        return view('checkout', [
            'cart' => $cart,
            'totalFinalPrice' => $totalFinalPrice,
        ]);
    }

    // Process the checkout
    public function process(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'transportation' => 'required|in:standard,express,pickup',
            'payment_method' => 'required|string|in:credit_card,paypal,cash_on_delivery',
        ]);

         // Calculate transportation cost
    $transportationCost = 0;
    switch ($request->transportation) {
        case 'standard':
            $transportationCost = 5.00;
            break;
        case 'express':
            $transportationCost = 10.00;
            break;
        case 'pickup':
            $transportationCost = 0.00;
            break;
    }

        // Get the cart items
        $cart = session()->get('cart', []);

        // Calculate the total final price
        $totalFinalPrice = 0;
        foreach ($cart as $item) {
            $totalFinalPrice += $item['attributes']['final_price'] * $item['quantity'];
        }

          // Add transportation cost to the total
          $totalFinalPrice += $transportationCost;

        // Save the order to the database (example)
        $order = Order::create([
            'user_id' => auth()->id(),
            'quantity' => $item['quantity'], // Quantity from the cart
            'price' => $item['price'], // Original price from the cart
            'points' => $item['attributes']['points'], // Points from the cart
            'discount' => $item['attributes']['discount'], // Discount from the cart
            'transportation_cost' => $transportationCost, // Transportation cost
            'final_price' => $item['attributes']['final_price'], // Final price from the cart
            'total_price' => $totalFinalPrice + $transportationCost, // Total price including transportation
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'address' => $request->address,
        ]);       

        // Clear the cart
        session()->forget('cart');

        // Redirect to a success page
        return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
    }

    // Checkout success page
    public function success()
    {
        return view('checkout_success');
    }
}
