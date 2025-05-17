@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Purchase Details') }}</div>

                <div class="card-body">

                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Customer Name</label>
                                    <input type="text" name="name" placeholder="Name" required autocomplete="name" value="{{ $purchase->user->name }}" class="form-control" disabled />
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" placeholder="Email" required autocomplete="email" value="{{ $purchase->user->email }}" class="form-control" disabled />

                                    @error('spec')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="count">Status</label>
                                    <input type="text" name="status" placeholder="Status" required autocomplete="status" class="form-control" min="1" value="{{ $purchase->status }}" disabled/>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="count">Approval Status</label>
                                    <input type="text" name="approval_status" placeholder="Status" required autocomplete="approval_status" class="form-control" min="1" value="{{ $purchase->approval_status }}" disabled/>
                                    @error('approval_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="approved_user">Approved User</label>
                                    <input type="text" name="approved_user" placeholder="Status" required autocomplete="approved_user" class="form-control" min="1" value="{{ $purchase->approval_status }}" disabled/>
                                    @error('approved_user')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">

                                <table class="table table-strip">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Days</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>


                                            </tr>

                                    </thead>
                                    <tbody>
@foreach ($purchase->purchaseItems as $purchasItem )
<tr>
<td>{{ $purchasItem->rentalModel->name }}</td>
<td>{{ $purchasItem->plan->price }}</td>
<td>{{ $purchasItem->quantity }}</td>
<td>{{ $purchasItem->days }}</td>
<td>{{ $purchasItem->start_date }}</td>
<td>{{ $purchasItem->end_date }}</td>


</tr>
@endforeach
                                    </tbody>
                                </table>

                            </div>


                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
