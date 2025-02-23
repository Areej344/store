@extends('layouts.app')

@section('content')
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <h1 class="display-4 mb-4 font-weight-bold" style="
                background: linear-gradient(45deg, #0d4785, #b6d9ee);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                animation: fadeInDown 1.5s ease-in-out;">
                 categories
                 </h1>
            <a href="{{ route('home') }}" class="btn btn-lg mb-4" style="
            background: linear-gradient(45deg, #14457a, #75a7be);
            border: none;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        ">
            <i class="fas fa-arrow-left"></i> Back to Home
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
                                <th>Actions</th>
                                <th>Images</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ Str::limit($category->description, 100) }}</td>
                                    <td>
                                        @if($category->image)
                                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" width="100">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-12">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection