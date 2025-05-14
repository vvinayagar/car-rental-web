@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="mb-4">
                <button onclick="window.location= '{{ route('rent.create') }}'" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rental Laptops') }}</div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="">
                        <tr>
                            <th>User Name</th>
                            <th>Rental Name</th>
                            <th>Plan Name</th>
                            <th>Plan Days</th>
                            <th>Plan Price</th>
                            <th>Payment Method</th>
                             <th>Details</th>
                              <th>Expiry</th>
                              <th>Status</th>
                            <th>Actions</th>
                        </tr>

                        @foreach ($rents as $rent)
                            <tr>
                                <td>{{ \App\Models\User::find($rent->user_id)->name   }}</td>
                                <td>{{ \App\Models\RentalModel::find($rent->rental_model_id)->name }}</td>
                                <td>{{ \App\Models\Plan::find($rent->plan_id)->name }}</td>
                                <td>{{ \App\Models\Plan::find($rent->plan_id)->days }}</td>
                                <td>{{ \App\Models\Plan::find($rent->plan_id)->price }}</td>
                                 <td>{{ $rent->payment_method }}</td>
                                <td>{{ $rent->details }}</td>
                                <td>{{ $rent->expiry }}</td>
                                <td>{{ $rent->status }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('rent.show', ['rent' => $rent->id]) }}'" >View</button>
                                        <button type="button" class="btn btn-warning" onclick="window.location='{{ route('rent.edit', ['rent' => $rent->id]) }}'" >Edit</button>
                                        <form method="post" action="{{ route('rent.destroy', ['rent' => $rent->id]) }}">
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
