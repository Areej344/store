<!-- resources/views/checkout_success.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="alert alert-success shadow-lg p-5 text-center" style="
        border-radius: 15px;
        background: linear-gradient(45deg, #28a745, #218838);
        color: white;
        border: none;
        animation: fadeIn 1s ease-in-out;
    ">
        <!-- Success Icon -->
        <div class="mb-4" style="font-size: 4rem;">
            <i class="fas fa-check-circle"></i>
        </div>

        <!-- Success Message -->
        <h1 class="display-4 mb-3" style="
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        ">
            {{ __('messages.order_placed_successfully') }}
        </h1>
        <p class="lead mb-4" style="font-size: 1.25rem;">
            {{ __('messages.thank_you_for_purchase') }}
        </p>

        <!-- Continue Shopping Button -->
        <a href="{{ route('home') }}" class="btn btn-light btn-lg" style="
            background: white;
            color: #28a745;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        ">
            <i class="fas fa-shopping-cart"></i> {{ __('messages.continue_shopping') }}
        </a>
    </div>
</div>

<!-- Custom CSS for Animations -->
<style>
    /* Fade-in Animation */
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    /* Hover Effect for Button */
    .btn-light:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection