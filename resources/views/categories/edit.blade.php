@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header text-white" style="background: linear-gradient(45deg, #14457a, #75a7be);">
                <h2 class="text-center mb-0">Edit Category</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Category Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control shadow-sm rounded-pill" 
                            value="{{ $category->name }}" 
                            required 
                            placeholder="Enter category name">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea 
                            name="description" 
                            class="form-control shadow-sm rounded" 
                            rows="4" 
                            placeholder="Enter category description">{{ $category->description }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-gradient-primary btn-lg text-white px-5" style="
                            background: linear-gradient(45deg, #14457a, #75a7be);
                            border: none;
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                        ">
                            Update Category
                        </button>

                        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-lg px-5" style="
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                        ">
                            Back to Categories
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
