@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                     <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('Rental Cars') }}</span>
                        
                                <button onclick="window.location= '{{ route('rental.create') }}'" type="button" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="">
                        <tr>
                            <th>Name</th>
                            <th>Spec</th>
                            <th>Type</th>
                            <th>Thumbnails</th>
                            <th>Actions</th>
                        </tr>

                        @foreach ($rentals as $rental)
                        <tr>
                            <td>{{ $rental->name }}</td>
                            <td>{{ $rental->spec }}</td>
                            <td>{{ $rental->type->name }}</td>

                            <td>
                                <img class="img-thumbnail" src="{{ asset('images/' . $rental->thumbnail) }}" alt="car" />
                                {{ $rental->thumbnail }}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('rental.show', ['rental' => $rental->id]) }}'">View</button>
                                    <button type="button" class="btn btn-warning" onclick="window.location='{{ route('rental.edit', ['rental' => $rental->id]) }}'">Edit</button>
                                    <form method="post" action="{{ route('rental.destroy', ['rental' => $rental->id]) }}">
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