@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <form method="POST" action="{{ route('checkout.checkout') }}" class="row g-3">
        @csrf
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email"
          value="{{ auth()->user()->email }}"
         disabled />
        </div>

        <div class="col-6">
          <label for="inputAddress" class="form-label">Address</label>
          <textarea class="form-control" id="inputAddress" placeholder="1234 Main St" required></textarea>
        </div>

        <div class="col-12">
            <label for="payment_type" class="form-label">Payment Type</label>
<select name="payment_type" class="form-select">
<option value="0">Demo Payment</option>
</select>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-secondary">Pay</button>
        </div>
      </form>
</div>
@endsection
