<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Easy Car Enterprise (ECE)</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample02">
                    <ul class="navbar-nav ms-auto">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        @role('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop.index') }}">{{ __('Shop') }}</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('brand.index') }}">{{ __('Brand') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transmission.index') }}">{{ __('Transmission') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('type.index') }}">{{ __('Type') }}</a>
                        </li>
                        <!--
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('category.index') }}">{{ __('Category') }}</a>
                            </li>
-->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rental.index') }}">{{ __('Rental') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('plan.index') }}">{{ __('Plan') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('purchase.index') }}">{{ __('Purchase') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.index') }}">{{ __('User') }}</a>
                        </li>
                        @endrole
                        @role('branch')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rental.index') }}">{{ __('Rental') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('plan.index') }}">{{ __('Plan') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('purchase.index') }}">{{ __('Purchase') }}</a>
                        </li>
                        @endrole
                        @role('user')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer_purchase.index') }}">{{ __('Purchase') }}</a>
                        </li>
                        @endrole
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} ({{ implode(', ', Auth::user()->getRoleNames()->toArray()) }})
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit', ['profile' => Auth::user()]) }}"
                                    onclick="">
                                    {{ __('Profile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                    <div>
                        <a href="{{ route('cart.view') }}" class="nav-link position-relative">
                            🛒 Cart
                            @if($cartItemCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartItemCount }}
                            </span>
                            @endif
                        </a>
                    </div>

                </div>
            </div>
        </nav>
    </header>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('brand.index') }}">{{ __('Brand') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.index') }}">{{ __('Category') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rental.index') }}">{{ __('Rental') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('plan.index') }}">{{ __('Plan') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rent.index') }}">{{ __('Rent') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}">{{ __('User') }}</a>
                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
    </nav> --}}


    @yield('content')

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- Other scripts/styles -->
    @stack('scripts') <!-- This allows child views to push scripts -->
</body>

</html>