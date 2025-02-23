@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- Gradient Heading with Animation -->
                    <h1 class="display-4 text-primary hover-effect" style="
                        background: linear-gradient(45deg, #1e538b, #c6d3cd);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                        font-family: 'Roboto', sans-serif;
                        font-weight: 700;
                        border-bottom: 4px solid #007bff;
                        padding-bottom: 10px;
                        display: inline-block;
                        animation: fadeInDown 1.5s ease-in-out;
                    ">
                        <i class="fas fa-info-circle"></i> {{ __('messages.product_details') }}
                    </h1>
                    <!-- Back Button with Gradient Background -->
                    <a href="{{ route('home') }}" class="btn btn-lg" style="
                        background: linear-gradient(45deg, #14457a, #75a7be);
                        border: none;
                        color: white;
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                    ">
                        <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_home') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Product Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded" style="
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                ">
                    <div class="card-body p-4">
                        <!-- Product Name -->
                        <h2 class="card-title text-dark mb-3" style="
                            font-size: 2rem;
                            font-weight: bold;
                        ">
                            {{ $product->name }}
                        </h2>

                        <!-- Product Description -->
                        <p class="card-text text-muted mb-4" style="
                            font-size: 1.1rem;
                            line-height: 1.6;
                        ">
                            {{ $product->description }}
                        </p>

                        <!-- Product Details -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="card-text"><strong>{{ __('messages.price') }}:</strong> ${{ number_format($product->price, 2) }}</p>
                                <p class="card-text"><strong>{{ __('messages.points') }}:</strong> {{ $product->points }}</p>
                                <p class="card-text"><strong>{{ __('messages.category') }}:</strong> {{ $product->category->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <!-- Product Image -->
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm" width="200" style="
                                        border-radius: 10px;
                                    ">
                                @else
                                    <p class="text-muted">{{ __('messages.no_image_available') }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Add to Cart Button -->
                        <div class="mt-4">
                            <form id="add-to-cart-{{ $product->id }}" action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="product_name" value="{{ $product->name }}">
                                <input type="hidden" name="product_price" value="{{ $product->price }}">
                                <button type="submit" class="btn btn-secondary btn-sm flex-grow-1">
                                    <i class="fas fa-cart-plus"></i> {{ __('messages.add_to_cart') }}
                                </button>
                            </form>
                        </div>
                    </div>
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
        .hover-effect {
            transition: transform 0.3s ease;
        }

        .hover-effect:hover {
            transform: scale(1.05);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }
    </style>
@endsection