@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Shopping Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Name</th>
                        <th scope="col" style="width: 120px;">Quantity</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Days</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp

                    @foreach(session('cart') as $id => $item)
                        @php
                            $rentalModel = App\Models\RentalModel::find($id);
                            $plan = App\Models\Plan::find($item['plan']);
                            $total =  $plan->price *  $item['quantity'] * $item['days'];//$item['price'] * $item['quantity'];
                            $grandTotal += $total;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . json_decode($rentalModel->images)[0])   }}" class="img-fluid rounded" style="max-width: 80px;" alt="product">
                            </td>
                            <td>{{ $rentalModel->name }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="2" class="form-control form-control-sm me-2" style="width: 70px;">
                                    <button class="btn btn-outline-secondary btn-sm">Update</button>
                                </form>
                            </td>
                            <td>{{ $item['start_date'] }}</td>
                            <td>{{ $item['end_date'] }}</td>


                            <td>{{ $item['days'] }}</td>
                            <td>${{ number_format($plan->price , 2) }}</td>
                            <td>${{ number_format($total, 2) }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <div class="card shadow-sm p-3" style="min-width: 300px;">
                <h5 class="mb-3">Cart Summary</h5>
                <div class="d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <strong>${{ number_format($grandTotal, 2) }}</strong>
                </div>
                <hr>
                <a href="{{ route('cart.detail') }}" class="btn btn-success w-100 mt-2">Proceed to Checkout</a>
            </div>
        </div>
    @else
        <div class="alert alert-info">Your cart is empty.</div>
    @endif
</div>
@endsection
