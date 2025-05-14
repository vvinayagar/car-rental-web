@extends('layouts.app')

@section('content')
<section id="section-main-banner">
<main class="px-3">
    <h1>Easy Car Enterprise <br/>(ECE)</h1>
    <p class="lead">Please login to proceed to booking.</p>
    <p class="lead">
      <a href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Learn more</a>
    </p>
    <button onclick="window.location.href = '/login'" class="btn btn-primary">Login</button>
    <a href="/register">Haven't register. Clicke here</a>
  </main>
</section>
@endsection
