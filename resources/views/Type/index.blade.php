@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('Type') }}</span>
                        <button onclick="window.location= '{{ route('type.create') }}'" type="button" class="btn btn-primary">Create</button>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="">
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>

                        @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->name }}</td>

                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('type.show', ['type' => $type]) }}'">View</button>
                                    <button type="button" class="btn btn-warning" onclick="window.location='{{ route('type.edit', ['type' => $type]) }}'">Edit</button>
                                    <form method="post" action="{{ route('type.destroy', ['type' => $type]) }}">
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