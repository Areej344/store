@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="display-4 mb-4 font-weight-bold" style="
                background: linear-gradient(45deg, #0d4785, #b6d9ee);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                animation: fadeInDown 1.5s ease-in-out;">
                 Products
                </h1>
            <a href="{{ route('products.create') }}" class="btn btn-lg mb-4" style="
            background: linear-gradient(45deg, #14457a, #75a7be);
            border: none;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        ">
            <i class="fas fa-plus-circle"></i> Create New Product
        </a>  
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Points</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ Str::limit($product->description, 100) }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->points }}</td>                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" width="100">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

       
    </div>
@endsection