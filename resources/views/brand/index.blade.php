@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Brand') }}
                    <div class="row justify-content-end">
                        <div class="col-md-2">
                            <div class="mb-4">
                                <button onclick="window.location= '{{ route('brand.create') }}'" type="button" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="">
                        <tr>
                            <th>Name</th>
                            <th>Images</th>
                            <th>Actions</th>
                        </tr>

                        @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->name }}</td>
                            <td>
                                @foreach (json_decode($brand->images) as $imgPath )
                                <img class="img img-thumbnail" src="{{ asset('images/' . $imgPath) }}" />
                                @endforeach

                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('brand.show', ['brand' => $brand]) }}'">View</button>
                                    <button type="button" class="btn btn-warning" onclick="window.location='{{ route('brand.edit', ['brand' => $brand]) }}'">Edit</button>
                                    <form method="post" action="{{ route('brand.destroy', ['brand' => $brand]) }}">
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