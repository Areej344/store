@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Page Heading with Gradient Text -->
        <h1 class="display-4 text-primary mb-4" style="
            background: linear-gradient(45deg, #224e7c, #b5c1c7);
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
            <i class="fas fa-plus-circle"></i> Create New Product
        </h1>

        <!-- Create Product Form -->
        <div class="card shadow-lg border-0 rounded">
            <div class="card-body p-4">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div class="form-group mb-4">
                        <label for="name" class="font-weight-bold">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" required style="
                            border: 1px solid #ced4da;
                            border-radius: 8px;
                            padding: 10px;
                        ">
                    </div>

                    <!-- Product Description -->
                    <div class="form-group mb-4">
                        <label for="description" class="font-weight-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" style="
                            border: 1px solid #ced4da;
                            border-radius: 8px;
                            padding: 10px;
                        "></textarea>
                    </div>

                    <!-- Product Price -->
                    <div class="form-group mb-4">
                        <label for="price" class="font-weight-bold">Price</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01" required style="
                            border: 1px solid #ced4da;
                            border-radius: 8px;
                            padding: 10px;
                        ">
                    </div>

                    <!-- Product Points -->
                    <div class="form-group mb-4">
                        <label for="points" class="font-weight-bold">Points</label>
                        <input type="number" name="points" id="points" class="form-control" required style="
                            border: 1px solid #ced4da;
                            border-radius: 8px;
                            padding: 10px;
                        ">
                    </div>

                    <!-- Product Quantity -->
                    <div class="form-group mb-4">
                        <label for="quantity" class="font-weight-bold">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required style="
                            border: 1px solid #ced4da;
                            border-radius: 8px;
                            padding: 10px;
                        ">
                    </div>

                    <!-- Product Category -->
                    <div class="form-group mb-4">
                        <label for="category_id" class="font-weight-bold">Category</label>
                        <select name="category_id" id="category_id" class="form-control" required style="
                            border: 1px solid #ced4da;
                            border-radius: 8px;
                            padding: 10px;
                        ">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Product Image -->
                    <div class="form-group mb-4">
                        <label for="image" class="font-weight-bold">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>

                    <!-- Form Buttons -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-lg btn-gradient-primary text-white" style="
                            background: linear-gradient(45deg, #14457a, #75a7be);
                            border: none;
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                        ">
                            <i class="fas fa-save"></i> Create Product
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-lg btn-secondary" style="
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                        ">
                            <i class="fas fa-arrow-left"></i> Back to Products
                        </a>
                    </div>
                </form>
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
    </style>
@endsection