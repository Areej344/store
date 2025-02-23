@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Service Details Section -->
        <div class="row text-center my-5">
            <div class="col-12">
                <!-- Service Icon -->
                <div class="icon-container mb-4" style="
                    background: linear-gradient(45deg, #14457a, #75a7be);
                    width: 100px;
                    height: 100px;
                    margin: 0 auto;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                    <i class="{{ $service['icon'] }} fa-3x text-white"></i>
                </div>
                <!-- Service Title -->
                <h2 class="text-uppercase font-weight-bold mb-4" style="
                    color: #0d4785;
                    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
                ">
                    {{ $service['title'] }}
                </h2>
                <!-- Service Description -->
                <p class="lead text-muted mb-4">{{ $service['description'] }}</p>
                <!-- Service Details -->
                <p class="text-muted">{{ $service['details'] }}</p>
                <!-- Back Button -->
                <a href="{{ route('services.index') }}" class="btn btn-outline-primary mt-4">
                    <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_services') }}
                </a>
            </div>
        </div>
    </div>
@endsection