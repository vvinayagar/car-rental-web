@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Brand') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('brand.update', ['brand' => $brand]) }}" class="form" type="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" placeholder="Name" required autocomplete="name" value="{{ $brand->name }}" class="form-control" />
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                            <button type="submit" name="save" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection