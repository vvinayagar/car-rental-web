@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="mb-4">
                <button onclick="window.location= '{{ route('shop.create') }}'" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Shop') }}</div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="">
                        <tr>
                            <th>Name</th>
                            <th>Address1</th>
                            <th>Address2</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Actions</th>
                        </tr>

                        @foreach ($shops as $shop)
                            <tr>
                                <td>{{ $shop->name }}</td>
                                <td>{{ $shop->address1 }}</td>
                                <td>{{ $shop->address2 }}</td>
                                <td>{{ $shop->city }}</td>
                                <td>{{ $shop->state }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('shop.show', ['shop' => $shop]) }}'" >View</button>
                                        <button type="button" class="btn btn-warning" onclick="window.location='{{ route('shop.edit', ['shop' => $shop]) }}'" >Edit</button>
                                        <form method="post" action="{{ route('shop.destroy', ['shop' => $shop]) }}">
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
