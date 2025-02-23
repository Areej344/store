<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.store_name') }}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>

          /* RTL-specific styles */
          [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .navbar-nav,
        [dir="rtl"] .dropdown-menu,
        [dir="rtl"] .form-inline,
        [dir="rtl"] .card,
        [dir="rtl"] .btn,
        [dir="rtl"] .text-left {
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

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(45deg, #224e7c, #b5c1c7); /* Gradient background */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff !important; /* White text */
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        .navbar-nav .nav-link {
            font-size: 1.1rem;
            color: #fff !important; /* White text */
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #f8f9fa !important; /* Light gray on hover */
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5); /* Light border for toggle button */
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

         /* Cart Dropdown Styling */
         .cart-dropdown {
            width: 350px; /* Adjust width */
            max-height: 400px; /* Set a max height */
            overflow-y: auto; /* Enable scrolling */
            padding: 1rem;
            background-color: #fff; /* White background */
            border-radius: 0.75rem; /* Rounded corners */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Soft shadow */
            border: 1px solid #e9ecef; /* Light border */
        }

        .cart-items-wrapper {
            max-height: 300px; /* Limit the height of items for scrolling */
            overflow-y: auto; /* Enable vertical scrolling */
            padding: 0.5rem;
        }

        .cart-item {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background-color: #f8f9fa; /* Light background */
            border-radius: 0.5rem; /* Rounded corners */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .cart-item:hover {
            transform: translateY(-5px); /* Lift the item on hover */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); /* Add a shadow on hover */
        }

        .cart-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .cart-item-header strong {
            font-size: 1.1rem;
            color: #224e7c; /* Dark blue text */
        }

        .remove-item {
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            color: #dc3545; /* Red color */
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .remove-item:hover {
            color: #c82333; /* Darker red on hover */
        }

        .cart-item p {
            margin: 0.25rem 0;
            font-size: 0.9rem;
            color: #6c757d; /* Gray text */
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: #e9ecef; /* Light border */
        }

        .total {
            font-weight: bold;
            font-size: 1.1rem;
            padding: 0.75rem 0;
            border-top: 1px solid #e9ecef; /* Light border */
            color: #224e7c; /* Dark blue text */
        }

        .btn-block {
            display: block;
            width: 100%;
            margin-top: 1rem;
            background-color: #224e7c; /* Dark blue background */
            color: #fff; /* White text */
            border: none;
            border-radius: 0.5rem; /* Rounded corners */
            padding: 0.75rem;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-block:hover {
            background-color: #1c3d5f; /* Darker blue on hover */
        }
          /* Badge Styling */
          .badge-danger {
            background-color: #dc3545; /* Red background */
            color: #fff; /* White text */
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.5rem; /* Rounded corners */
          }

        /* Dropdown Menu Styling */
        .dropdown-menu {
            border-radius: 0.5rem; /* Rounded corners */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Soft shadow */
        }

        .dropdown-item {
            padding: 0.5rem 1rem; /* Padding for dropdown items */
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa; /* Light background on hover */
        }

        /* Search Bar Styling */
        .form-inline .form-control {
            border-radius: 0.5rem; /* Rounded corners */
            border: 1px solid rgba(255, 255, 255, 0.5); /* Light border */
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent background */
            color: #fff; /* White text */
        }

        .form-inline .btn-outline-success {
            border-radius: 0.5rem; /* Rounded corners */
            border-color: rgba(255, 255, 255, 0.5); /* Light border */
            color: #fff; /* White text */
        }

        .form-inline .btn-outline-success:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent background on hover */
        }
        .btn-gradient:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #14457a !important;
    }

    .dropdown-item i {
        margin-right: 0.5rem;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="container">
            <!-- Brand/Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <span class="font-weight-bold">{{ __('messages.store_name') }}</span>
            </a>

            <!-- Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left Side: Search Bar -->
                <form action="{{ route('search') }}" method="GET" class="form-inline my-2 my-lg-0 mx-auto">
                    <input class="form-control mr-sm-2" type="search" name="query" placeholder="{{ __('messages.search_placeholder') }}" aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <!-- Right Side: Cart and Profile -->
                <ul class="navbar-nav ml-auto">
                    <!-- Cart Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="cartDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge badge-danger">{{ count(Session::get('cart', [])) }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right cart-dropdown" aria-labelledby="cartDropdown">
                            @if(empty(Session::get('cart')))
                                <p class="dropdown-item text-center">{{ __('messages.cart_empty') }}</p>
                            @else
                                <div class="cart-items-wrapper">
                                    @php $totalFinalPrice = 0; @endphp
                                    @foreach(Session::get('cart') as $id => $item)
                                        @php $totalFinalPrice += $item['attributes']['final_price'] * $item['quantity']; @endphp
                                        <div class="dropdown-item cart-item">
                                            <div class="cart-item-header">
                                                <strong>{{ $item['name'] }}</strong>
                                                <a href="#" class="text-danger remove-item" onclick="event.preventDefault(); document.getElementById('remove-form-{{ $id }}').submit();">&times;</a>
                                                <form id="remove-form-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                            <p>{{ __('messages.price') }}: ${{ number_format($item['price'], 2) }}</p>
                                            <p>{{ __('messages.quantity') }}: {{ $item['quantity'] }}</p>
                                            <p>{{ __('messages.points') }}: {{ $item['attributes']['points'] }}</p>
                                            <p>{{ __('messages.discount') }}: ${{ number_format($item['attributes']['discount'], 2) }}</p>
                                            <p>{{ __('messages.final_price') }}: ${{ number_format($item['attributes']['final_price'], 2) }}</p>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                    @endforeach
                                </div>
                                <div class="dropdown-item total">
                                    <strong>{{ __('messages.total') }}: </strong> ${{ number_format($totalFinalPrice, 2) }}
                                </div>
                                <div class="dropdown-item">
                                    <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">{{ __('messages.checkout') }}</a>
                                </div>
                            @endif
                        </div>
                    </li>

                    <!-- Authentication Links -->
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('messages.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-user-circle"></i> {{ __('messages.login') }}
                            </a>
                        </li>
                    @endguest
                </ul>

                <!-- Language Switcher -->
                <div class="dropdown ml-2">
                    <button class="btn btn-gradient dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="
                        background: linear-gradient(45deg, #14457a, #75a7be);
                        border: none;
                        color: white;
                        padding: 0.5rem 1rem;
                        border-radius: 0.5rem;
                        font-size: 1rem;
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                    ">
                        <i class="fas fa-globe"></i> {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown" style="
                        border-radius: 0.5rem;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        border: none;
                    ">
                        <a class="dropdown-item" href="{{ route('locale.switch', 'en') }}" style="
                            padding: 0.5rem 1rem;
                            font-size: 0.9rem;
                            color: #333;
                            transition: background-color 0.3s ease, color 0.3s ease;
                        ">
                            <i class="fas fa-flag-usa"></i> English (EN)
                        </a>
                        <a class="dropdown-item" href="{{ route('locale.switch', 'ar') }}" style="
                            padding: 0.5rem 1rem;
                            font-size: 0.9rem;
                            color: #333;
                            transition: background-color 0.3s ease, color 0.3s ease;
                        ">
                            <i class="fas fa-flag"></i> العربية (AR)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>