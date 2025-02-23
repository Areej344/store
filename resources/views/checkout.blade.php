<!-- resources/views/checkout.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container my-3">
    <!-- Page Heading -->
    <h1 class="display-4 text-primary mb-4" style="background: linear-gradient(45deg, #4696d3, #eaeef1); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
        {{ __('messages.checkout') }}
    </h1>

    <!-- Display Cart Items -->
    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <h5 class="card-title text-dark mb-4">{{ __('messages.your_cart') }}</h5>
            @if (count($cart) > 0)
                @foreach ($cart as $id => $item)
                    <div class="mb-4 p-3 border-bottom">
                        <h6 class="text-primary">{{ $item['name'] }}</h6>
                        <p class="text-muted">{{ __('messages.price') }}: ${{ number_format($item['price'], 2) }}</p>
                        <p class="text-muted">{{ __('messages.quantity') }}: {{ $item['quantity'] }}</p>
                        <p class="text-muted">{{ __('messages.points') }}: {{ $item['attributes']['points'] }}</p>
                        <p class="text-muted">{{ __('messages.discount') }}: ${{ number_format($item['attributes']['discount'], 2) }}</p>
                        <p class="text-muted">{{ __('messages.final_price') }}: ${{ number_format($item['attributes']['final_price'], 2) }}</p>
                    </div>
                @endforeach
                <h5 class="text-dark mt-4">{{ __('messages.subtotal') }}: ${{ number_format($totalFinalPrice, 2) }}</h5>
            @else
                <p class="text-muted">{{ __('messages.cart_empty') }}</p>
            @endif
        </div>
    </div>

    <!-- Checkout Form -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title text-dark mb-4">{{ __('messages.checkout_details') }}</h5>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <!-- Name Field -->
                <div class="form-group mb-4">
                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" required>
                </div>

                <!-- Email Field -->
                <div class="form-group mb-4">
                    <label for="email" class="form-label">{{ __('messages.email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
                </div>

                <!-- Address Field -->
                <div class="form-group mb-4">
                    <label for="address" class="form-label">{{ __('messages.address') }}</label>
                    <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                </div>

                <!-- Transportation Options -->
                <div class="form-group mb-4">
                    <label for="transportation" class="form-label">{{ __('messages.transportation_method') }}</label>
                    <select name="transportation" id="transportation" class="form-control" required>
                        <option value="" disabled selected>{{ __('messages.select_transportation') }}</option>
                        <option value="standard">{{ __('messages.standard_delivery') }}</option>
                        <option value="express">{{ __('messages.express_delivery') }}</option>
                        <option value="pickup">{{ __('messages.store_pickup') }}</option>
                    </select>
                </div>

                <!-- Payment Method -->
                <div class="form-group mb-4">
                    <label for="payment_method" class="form-label">{{ __('messages.payment_method') }}</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="credit_card">{{ __('messages.credit_card') }}</option>
                        <option value="paypal">{{ __('messages.paypal') }}</option>
                        <option value="cash_on_delivery">{{ __('messages.cash_on_delivery') }}</option>
                    </select>
                </div>

                <!-- Display Total Price with Transportation -->
                <div class="form-group mb-4">
                    <h5 class="text-dark">{{ __('messages.total') }}: $<span id="totalPrice">{{ number_format($totalFinalPrice, 2) }}</span></h5>
                </div>

                <!-- Place Order Button -->
                <button type="submit" class="btn btn-primary btn-block btn-lg" style="background: linear-gradient(45deg, #007bff, #7bb8c7); border: none; transition: transform 0.3s ease;">
                    {{ __('messages.place_order') }}
                </button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to Calculate Total Price with Transportation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const transportationSelect = document.getElementById('transportation');
        const totalPriceElement = document.getElementById('totalPrice');
        const subtotal = {{ $totalFinalPrice }}; // Subtotal from the cart

        transportationSelect.addEventListener('change', function () {
            let transportationCost = 0;

            switch (this.value) {
                case 'standard':
                    transportationCost = 5.00;
                    break;
                case 'express':
                    transportationCost = 10.00;
                    break;
                case 'pickup':
                    transportationCost = 0.00;
                    break;
            }

            const totalPrice = subtotal + transportationCost;
            totalPriceElement.textContent = totalPrice.toFixed(2); // Update the total price
        });
    });
</script>

<!-- Custom CSS for Additional Styling -->
<style>
    /* Hover Effect for Place Order Button */
    .btn-primary:hover {
        transform: scale(1.05); /* Slightly enlarge on hover */
    }

    /* Custom Font for Headings */
    h1, h5 {
        font-family: 'Roboto', sans-serif;
        font-weight: 700;
    }

    /* Card Styling */
    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn-block {
        border-radius: 10px;
    }
</style>
@endsection