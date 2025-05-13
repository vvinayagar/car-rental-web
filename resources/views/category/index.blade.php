@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="mb-4">
                <button onclick="window.location= '{{ route('category.create') }}'" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Category') }}</div>

                <div class="card-body">
                    <table class="table table-striped table-responsive" id="">
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>

                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('category.show', ['id' => $category->id, 'category' => $category->id]) }}'" >View</button>
                                        <button type="button" class="btn btn-warning" onclick="window.location='{{ route('category.edit', ['id' => $category->id, 'category' => $category->id]) }}'" >Edit</button>
                                        <form method="post" action="{{ route('category.destroy', ['id' => $category->id, 'category' => $category->id]) }}">
                                            <button type="button" class="btn btn-danger">Delete</button>
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
