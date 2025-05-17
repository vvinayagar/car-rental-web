@extends('layouts.app')

@section('content')
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        {{-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg> --}}
<img class="bd-placeholder-img" src="/images/pexels-brett-sayles-1638459.jpg" />
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Example headline.</h1>
            <p>Some representative placeholder content for the first slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" src="/images/pexels-mikebirdy-977003.jpg" />
        <div class="container">
          <div class="carousel-caption">
            <h1>Another example headline.</h1>
            <p>Some representative placeholder content for the second slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" src="/images/pexels-mikebirdy-1035108.jpg" />

        <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>Some representative placeholder content for the third slide of this carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
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
    @if(session('success'))
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
    <ul class="nav">
        <li class="nav-item">
          <a class="nav-link {{ $filter == 0 ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">All</a>
        </li>
@foreach ($shops as $shop)
<li class="nav-item">
    <a class="nav-link  {{ $filter ==  $shop->id ? 'active' : '' }}" href="{{ route('home', ['filter' => $shop->id ]) }}">{{ $shop->name }}</a>
  </li>
@endforeach


      </ul>

</div>

@foreach ($rentals as $rental)
<div class="col-sm-6 col-lg-4 mb-4">

    <div class="card m-3">
      {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg> --}}
      @foreach (json_decode($rental->images) as $imgPath )
      <img class="img img-thumbnail" src="{{ asset('images/' . $imgPath) }}" />
      @endforeach
      <div class="card-body">
        <h5 class="card-title">@if($rental->brand != null) {{ $rental->brand->name }}@endif - {{ $rental->name }}</h5>
        <p class="card-text">{{ $rental->spec }}.</p>
      </div>
      <div class="card-footer">
        <a href="{{ route('cart.product',['rental' => $rental]) }}" class="btn btn-secondary">Rent</a>
        <div class="price-footer">@foreach ($rental->plans as $plan)
          <span class="badge rounded-pill bg-info m-3">{{ $plan->days }} Days - RM {{ $plan->price }}</span>
        @endforeach</div>
      </div>
    </div>
  </div>
@endforeach


</div>
</div>
@endsection
