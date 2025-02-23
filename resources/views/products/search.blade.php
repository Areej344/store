@extends('layouts.app')

@section('content')
    <div class="container my-3">
        <!-- Page Heading with Gradient Text -->
        <h1 class="display-4 text-primary mb-4" style="background: linear-gradient(45deg, #224e7c, #b5c1c7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
            {{ __('messages.search_results_for', ['query' => $query]) }}
        </h1>

        <!-- Search Results -->
        <div class="row">
            @if($products->isEmpty())
                <div class="col-12">
                    <p class="text-muted">{{ __('messages.no_products_found') }}</p>
                </div>
            @else
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg border-0 rounded h-100 product-card" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                <!-- Product Image -->
                                <div class="card-img-container" style="position: relative; padding-top: 100%;">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="card-img-top rounded-top" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <!-- Product Details -->
                                <div class="card-body">
                                    <h5 class="card-title text-dark">{{ $product->name }}</h5>
                                    <p class="card-text text-muted">{{ __('messages.price') }}: ${{ number_format($product->price, 2) }}</p>
                                    <p class="card-text text-muted"><strong>{{ __('messages.points') }}:</strong> {{ $product->points }}</p>
                                </div>
                            </a>
                            <!-- Add to Cart Form -->
                            <div class="card-footer bg-transparent border-0">
                                <form id="add-to-cart-{{ $product->id }}" action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                    <input type="hidden" name="product_price" value="{{ $product->price }}">
                                    <!-- Size Selection -->
                                    <select name="size" class="form-select form-select-sm" style="width: auto;" required>
                                        {{-- <option value="" disabled selected>{{ __('messages.select_size') }}</option> --}}
                                        <option value="S">{{ __('messages.small') }}</option>
                                        <option value="M">{{ __('messages.medium') }}</option>
                                        <option value="L">{{ __('messages.large') }}</option>
                                        <option value="XL">{{ __('messages.extra_large') }}</option>
                                    </select>
                                    <!-- Add to Cart Button -->
                                    <button type="submit" class="btn btn-secondary btn-sm flex-grow-1" style="transition: background-color 0.3s ease, color 0.3s ease;">
                                        <i class="fas fa-cart-plus"></i> {{ __('messages.add_to_cart') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Custom CSS for Card Sizing -->
    <style>
        /* Fixed Height for Image Container */
        .card-img-container {
            height: 200px; /* Fixed height for the image container */
            overflow: hidden; /* Ensure the image doesn't overflow */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Ensure Image Fills the Container */
        .card-img-top {
            width: 100%; /* Ensure the image takes full width */
            height: 100%; /* Ensure the image takes full height */
            object-fit: cover; /* Maintain aspect ratio and cover the container */
        }

        /* Consistent Card Height */
        .product-card {
            display: flex;
            flex-direction: column;
            height: 100%; /* Ensure all cards have the same height */
        }

        /* Allow Card Body to Grow */
        .card-body {
            flex-grow: 1; /* Allow the card body to grow and fill space */
        }

        /* Prevent Footer from Shrinking */
        .card-footer {
            flex-shrink: 0; /* Prevent the footer from shrinking */
        }

        /* Hover Effect for Product Cards */
        .product-card:hover {
            transform: translateY(-10px); /* Lift the card on hover */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Add a stronger shadow on hover */
        }

        /* Hover Effect for Add to Cart Button */
        .btn-secondary:hover {
            background-color: #007bff; /* Change background color on hover */
            color: #fff; /* Change text color on hover */
        }

        /* Custom Font for Headings */
        h1 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
        }

        /* Card Styling */
        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
        }

        .form-select {
            border-radius: 10px;
        }

        .btn-sm {
            border-radius: 10px;
        }
    </style>
@endsection