@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Category Header Section -->
        <div class="row">
            <div class="col-12 text-center">
                <!-- Gradient Heading with Animation -->
                <h1 class="display-4 mb-4 font-weight-bold" style="
                    background: linear-gradient(45deg, #0d4785, #b6d9ee);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                    animation: fadeInDown 1.5s ease-in-out;
                ">
                    {{ __('messages.category') }}: {{ $category->name }}
                </h1>

                <!-- Back Button with Gradient Background -->
                <a href="{{ route('home') }}" class="btn btn-lg mb-4" style="
                    background: linear-gradient(45deg, #14457a, #75a7be);
                    border: none;
                    color: white;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                ">
                    <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_home') }}
                </a>
            </div>
        </div>

        <!-- Category Details Section -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg mb-5" style="
                    border: none;
                    border-radius: 15px;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                ">
                    <div class="card-body p-4">
                        <!-- Category Name -->
                        <h2 class="card-title text-dark mb-3" style="
                            font-size: 2rem;
                            font-weight: bold;
                        ">
                            {{ $category->name }}
                        </h2>
                        <!-- Category Description -->
                        <p class="card-text text-muted" style="
                            font-size: 1.1rem;
                            line-height: 1.6;
                        ">
                            {{ $category->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products in Category Section -->
        <div class="row">
            <div class="col-12">
                <h2 class="text-uppercase font-weight-bold mb-4" style="
                    color: #0d4785;
                    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
                ">
                    {{ __('messages.products_in_category', ['category' => $category->name]) }}
                </h2>
                <div class="row">
                    @foreach($category->products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-lg border-0 rounded h-100 product-card" style="
                                transition: transform 0.3s ease, box-shadow 0.3s ease;
                            ">
                                <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                    <!-- Product Image -->
                                    <div class="card-img-container" style="
                                        position: relative;
                                        padding-top: 100%;
                                    ">
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="card-img-top rounded-top" style="
                                            position: absolute;
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            height: 100%;
                                            object-fit: cover;
                                        ">
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
                                            <option value="" disabled selected>{{ __('messages.select_size') }}</option>
                                            <option value="S">Small (S)</option>
                                            <option value="M">Medium (M)</option>
                                            <option value="L">Large (L)</option>
                                            <option value="XL">Extra Large (XL)</option>
                                        </select>
                                        <!-- Add to Cart Button -->
                                        <button type="submit" class="btn btn-secondary btn-sm flex-grow-1">
                                            <i class="fas fa-cart-plus"></i> {{ __('messages.add_to_cart') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        /* Animations */
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Hover Effects */
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        /* RTL-specific styles */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .card-title,
        [dir="rtl"] .card-text,
        [dir="rtl"] .form-control,
        [dir="rtl"] .btn,
        [dir="rtl"] .dropdown-menu {
            text-align: right;
        }

        [dir="rtl"] .ml-auto {
            margin-left: 0 !important;
            margin-right: auto !important;
        }

        [dir="rtl"] .mr-auto {
            margin-right: 0 !important;
            margin-left: auto !important;
        }

        [dir="rtl"] .float-left {
            float: right !important;
        }

        [dir="rtl"] .float-right {
            float: left !important;
        }

        [dir="rtl"] .text-left {
            text-align: right !important;
        }

        [dir="rtl"] .text-right {
            text-align: left !important;
        }
    </style>
@endsection