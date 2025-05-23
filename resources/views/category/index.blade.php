@extends('layouts.app')

@section('content') 
<div class="container mt-3">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Category') }}
                    <div class="row justify-content-end">
                        <div class="col-md-2">
                            <div class="mb-4">
                                <button onclick="window.location= '{{ route('category.create') }}'" type="button" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>

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
                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('category.show', [ 'category' => $category]) }}'">View</button>
                                        <button type="button" class="btn btn-warning" onclick="window.location='{{ route('category.edit', [ 'category' => $category]) }}'">Edit</button>
                                        <form method="post" action="{{ route('category.destroy', [ 'category' => $category]) }}">
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