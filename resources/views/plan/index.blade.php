@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="mb-4">
                <button onclick="window.location= '{{ route('plan.create') }}'" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Plans') }}</div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="">
                        <tr>
                            <th>Name</th>
                            <th>Days</th>
                            <th>Price</th>
                            <th>Rental Name</th>
                        </tr>

                        @foreach ($plans as $plan)
@if($plan->rental != null)

                            <tr>
                                <td>{{ $plan->name }}</td>
                                 <td>{{ $plan->days }}</td>
                                 <td>{{ $plan->price }}</td>
                                 <td>{{ \App\Models\RentalModel::where('id', $plan->rental_model_id )->first()->name}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('plan.show', ['plan' => $plan]) }}'" >View</button>
                                        <button type="button" class="btn btn-warning" onclick="window.location='{{ route('plan.edit', ['plan' => $plan]) }}'" >Edit</button>
                                        <form method="post" action="{{ route('plan.destroy', [ 'plan' => $plan]) }}">
                                        @csrf
                                        @method('delete')    
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
