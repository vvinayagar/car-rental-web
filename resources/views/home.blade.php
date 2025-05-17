@extends('layouts.app')

@section('content')
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                {{-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg> --}}
                <img class="bd-placeholder-img" src="/images/pexels-brett-sayles-1638459.jpg" />
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Welcome to Easy Car Enterprise</h1>
                        <p>Easy Car Rental For You</p>
                        <!--<p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>-->
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="bd-placeholder-img" src="/images/pexels-mikebirdy-977003.jpg" />
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Welcome to Easy Car Enterprise</h1>
                        <p>Easy Car Rental For You</p>
                        <!--<p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>-->
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="bd-placeholder-img" src="/images/pexels-mikebirdy-1035108.jpg" />

                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>Welcome to Easy Car Enterprise</h1>
                        <p>Easy Car Rental For You</p>
                        <!--<p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>-->
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container mt-3">
        {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        <div class="rentals row" data-masonry='{"percentPosition": true }'>

            @php

            @endphp

            <div class="col-12 filter">
                <!-- <ul class="nav">
            <li class="nav-item">
              <a class="nav-link {{ $filter == 0 ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">All</a>
            </li>
    @foreach ($shops as $shop)
    <li class="nav-item">
        <a class="nav-link  {{ $filter == $shop->id ? 'active' : '' }}" href="{{ route('home', ['filter' => $shop->id]) }}">{{ $shop->name }}</a>
      </li>
    @endforeach


          </ul> -->


                <div class="row">
                    <div class="col-12"> <label>Filters</label></div>
                    <div class="col">
                        <label>Shop</label>
                        <select id="filter" class="form-control">
                            <option value="0">All</option>
                            @foreach ($shops as $shop)
                                <option {{ $filter == $shop->id ? 'selected' : '' }} value="{{ $shop->id }}">
                                    {{ $shop->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label>Brand</label>
                        <select id="brand" class="form-control">
                            <option value="0">All</option>
                            @foreach ($brands as $brandVal)
                                <option {{ $brand == $brandVal->id ? 'selected' : '' }} value="{{ $brandVal->id }}">
                                    {{ $brandVal->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label>Car Type</label>
                        <select id="type" class="form-control">
                            <option value="0">All</option>
                            @foreach ($types as $typeVal)
                                <option {{ $type == $typeVal->id ? 'selected' : '' }} value="{{ $typeVal->id }}">
                                    {{ $typeVal->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label>Transmission</label>
                        <select id="transmission" class="form-control">
                            <option value="0">All</option>
                            @foreach ($transmissions as $transmissionVal)
                                <option {{ $transmission == $transmissionVal->id ? 'selected' : '' }} value="{{ $transmissionVal->id }}">
                                    {{ $transmissionVal->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col m-3">
                        <button class="btn btn-secondary"
                            onclick="window.location.href = '/home?filter=' + document.getElementById('filter').value + '&brand='  + document.getElementById('brand').value + '&type='  + document.getElementById('type').value + '&transmission='  + document.getElementById('transmission').value">Filter</button>
                    </div>
                </div>

            </div>

            @foreach ($rentals as $rental)
                <div class="col-sm-6 col-lg-4 mb-4">

                    <div class="card m-3">
                        {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg> --}}
                        @foreach (json_decode($rental->images) as $imgPath)
                            <img class="img img-thumbnail" src="{{ asset('images/' . $imgPath) }}" />
                        @endforeach
                        <div class="card-body">
                            <h5 class="card-title">
                                @if ($rental->brand != null)
                                    {{ $rental->brand->name }}
                                @endif - {{ $rental->name }}
                            </h5>
                            <p class="card-text">{{ $rental->spec }}.</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('cart.product', ['rental' => $rental]) }}"
                                class="btn btn-secondary">Rent</a>
                            <div class="price-footer">
                                @foreach ($rental->plans as $plan)
                                    <span class="badge rounded-pill bg-info m-3">{{ $plan->days }} Days - RM
                                        {{ $plan->price }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection
