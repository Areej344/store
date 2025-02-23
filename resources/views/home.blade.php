@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Welcome Section -->
        <div class="row text-center mb-5">
            <div class="col-12">
                <!-- Gradient Heading with Animation -->
                <h1 class="display-4 mb-3 font-weight-bold" style="
                    background: linear-gradient(45deg, #0d4785, #b6d9ee);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                    animation: fadeInDown 1.5s ease-in-out;
                ">
                    {{ __('messages.welcome') }}
                </h1>

                <!-- Subheading with Animation -->
                <p class="lead text-muted mb-4" style="
                    font-family: 'Roboto', sans-serif;
                    animation: fadeInUp 1.5s ease-in-out;
                ">
                    {{ __('messages.discover_products') }}
                </p>

                <!-- Gradient Button with Hover Effect -->
                <a href="#categories" class="btn btn-lg text-white mt-4" style="
                    background: linear-gradient(45deg, #14457a, #75a7be);
                    border: none;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                    animation: fadeIn 2s ease-in-out;
                ">
                    {{ __('messages.start_shopping') }}
                </a>
            </div>
        </div>

        <!-- Categories Section -->
        <div id="categories" class="row text-center mb-5">
            <div class="col-12">
                <h2 class="text-uppercase font-weight-bold mb-4" style="
                    color: #0d4785;
                    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
                ">
                    {{ __('messages.browse_categories') }}
                </h2>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-lg border-0 rounded h-100 category-card" style="
                                transition: transform 0.3s ease, box-shadow 0.3s ease;
                            ">
                                <!-- Category Image -->
                                <div class="card-img-container" style="
                                    height: 200px;
                                    overflow: hidden;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                ">
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="card-img-top rounded-top" style="
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                    ">
                                </div>
                                <!-- Category Details -->
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $category->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($category->description, 100) }}</p>
                                </div>
                                <!-- Explore Button -->
                                <div class="card-footer bg-transparent border-0">
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-primary btn-explore" style="
                                        transition: background-color 0.3s ease, color 0.3s ease;
                                    ">
                                        {{ __('messages.explore') }} <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Featured Products Section -->
        <div id="featured-products" class="row text-center">
            <div class="col-12">
                <h2 class="text-uppercase font-weight-bold mb-4" style="
                    color: #0d4785;
                    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
                ">
                    {{ __('messages.featured_products') }}
                </h2>
                <div class="row">
                    @foreach($products as $product)
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
                                        <p class="card-text text-muted">${{ number_format($product->price, 2) }}</p>
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

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Hover Effects */
        .category-card:hover, .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-explore:hover {
            background-color: #224b6d;
            color: #fff;
        }

        .btn-gradient-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }
    </style>
@endsection