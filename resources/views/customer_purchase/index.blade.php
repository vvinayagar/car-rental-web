@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('failed'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="mb-4">
                <button onclick="window.location= '{{ route('purchase.create') }}'" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Rental Cars') }}</div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="">
                        <tr>
                            <th>User Name</th>
                            <th>Rental Details</th>
                            <th>Payment type</th>
                            <th>Payment Amount</th>

                            <th>Payment Method</th>
                             <th>Status</th>
                              <th>Approval</th>

                            <th>Actions</th>
                        </tr>

                        @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ \App\Models\User::find($purchase->user_id)->name   }}</td>
                                <td>
<table class="table table-info">
<thead>
<tr>
<th>Name</th>
<th>Brand</th>
<th>Quantity</th>
<th>Price</th>
</tr>
</thead>
<tbody>
@foreach ($purchase->purchaseItems as $purchaseItem )
<tr>
    <td>{{ $purchaseItem->rentalModel->name }}</td>
    <td>{{ $purchaseItem->rentalModel->brand->name }}</td>
    <td>{{ $purchaseItem->quantity }}</td>
    <td>{{ $purchaseItem->price }}</td>

</tr>
@endforeach
</tbody>
</table>


                                </td>
                                <td>{{ $purchase->payment_type}}</td>
                                <td>{{ $purchase->amount }}</td>
                                 <td>{{ $purchase->payment_type }}</td>
                                <td>{{ $purchase->status }}</td>
                                <td>{{ $purchase->approval_status }}</td>
                                <td>
                                    <div class="btn-group">
@if ($purchase->approval_status == "pending")
<a href="{{ route("purchase.approve", ['purchase' => $purchase]) }}" class="btn btn-success">Approve</a>
<a href="{{ route("purchase.reject", ['purchase' => $purchase]) }}" class="btn btn-danger">Reject</a>

@endif

                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('purchase.show', ['purchase' => $purchase->id]) }}'" >View</button>
                                        {{-- <button type="button" class="btn btn-warning" onclick="window.location='{{ route('purchase.edit', ['purchase' => $purchase->id]) }}'" >Edit</button> --}}
                                        <form method="post" action="{{ route('purchase.destroy', ['purchase' => $purchase->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
