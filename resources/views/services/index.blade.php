@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Services Section -->
        <div id="services" class="row text-center my-5">
            <div class="col-12">
                <!-- Section Heading -->
                <h2 class="text-uppercase font-weight-bold mb-4" style="
                    color: #0d4785;
                    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
                ">
                    {{ __('messages.our_services') }}
                </h2>
                <p class="lead text-muted mb-5" style="
                    font-family: 'Roboto', sans-serif;
                ">
                    {{ __('messages.services_intro') }}
                </p>

                <!-- Service Cards -->
                <div class="row">
                    @foreach($services as $service)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-lg border-0 rounded h-100 service-card" style="
                                transition: transform 0.3s ease, box-shadow 0.3s ease;
                            ">
                                <div class="card-body p-4">
                                    <!-- Service Icon -->
                                    <div class="icon-container mb-4" style="
                                        background: linear-gradient(45deg, #14457a, #75a7be);
                                        width: 80px;
                                        height: 80px;
                                        margin: 0 auto;
                                        border-radius: 50%;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                    ">
                                        <i class="{{ $service['icon'] }} fa-2x text-white"></i>
                                    </div>
                                    <!-- Service Title -->
                                    <h5 class="card-title text-primary mb-3">{{ $service['title'] }}</h5>
                                    <!-- Service Description -->
                                    <p class="card-text text-muted">{{ $service['description'] }}</p>
                                    <!-- Learn More Button -->
                                    <a href="{{ route('services.show', $service['id']) }}" class="btn btn-outline-primary btn-sm mt-3">
                                        {{ __('messages.learn_more') }} <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection