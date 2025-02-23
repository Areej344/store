@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 mb-4 fw-bold" style="
                    background: linear-gradient(45deg, #0d4785, #b6d9ee);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                    animation: fadeInDown 1.5s ease-in-out;
                ">
                    Edit Product
                </h1>
            </div>
        </div>

        <!-- Edit Product Form -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded" style="
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                ">
                    <div class="card-body p-4">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Product Name -->
                            <div class="form-group mb-4">
                                <label for="name" class="fw-bold">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control shadow-sm" value="{{ $product->name }}" required placeholder="Enter product name">
                            </div>

                            <!-- Product Description -->
                            <div class="form-group mb-4">
                                <label for="description" class="fw-bold">Description</label>
                                <textarea name="description" id="description" class="form-control shadow-sm" rows="4" placeholder="Enter product description">{{ $product->description }}</textarea>
                            </div>

                            <!-- Product Price -->
                            <div class="form-group mb-4">
                                <label for="price" class="fw-bold">Price</label>
                                <input type="number" name="price" id="price" class="form-control shadow-sm" value="{{ $product->price }}" step="0.01" required>
                            </div>

                            <!-- Product Points -->
                            <div class="form-group mb-4">
                                <label for="points" class="fw-bold">Points</label>
                                <input type="number" name="points" id="points" class="form-control shadow-sm" value="{{ $product->points }}" required>
                            </div>

                            <!-- Product Quantity -->
                            <div class="form-group mb-4">
                                <label for="quantity" class="fw-bold">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control shadow-sm" value="{{ $product->quantity }}" required>
                            </div>

                            <!-- Product Category -->
                            <div class="form-group mb-4">
                                <label for="category_id" class="fw-bold">Category</label>
                                <select name="category_id" id="category_id" class="form-control shadow-sm" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product Image -->
                            <div class="form-group mb-4">
                                <label for="image" class="fw-bold">Product Image</label>
                                <input type="file" name="image" id="image" class="form-control-file">
                                @if($product->image)
                                    <div class="mt-3">
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail shadow" width="150">
                                    </div>
                                @endif
                            </div>

                            <!-- Form Buttons -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-lg btn-gradient-primary text-white me-3" style="
                                    background: linear-gradient(45deg, #14457a, #75a7be);
                                    border: none;
                                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                                ">
                                    Update Product
                                </button>
                                <a href="{{ route('products.index') }}" class="btn btn-lg btn-secondary" style="
                                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                                ">
                                    Back to Products
                                </a>
                            </div>
                        </form>
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
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-gradient-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-secondary:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        .img-thumbnail {
            border-radius: 12px;
        }

        textarea::placeholder, input::placeholder {
            color: #6c757d;
        }
    </style>
@endsection
