@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Plan') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('plan.store') }}" class="form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" placeholder="Name" required autocomplete="name"
                                        class="form-control" />
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Days</label>
                                    <input type="number" name="days" placeholder="Days" required autocomplete="days"
                                        class="form-control" />
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Price</label>
                                    <input type="number" name="price" placeholder="Price" required autocomplete="price" class="form-control" />
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="spec">Rental Type</label>
                                   <select id="brand" name="rental" placeholder="Rental" required class="form-control">
                                        @foreach ($rentals as $rental)
                                            <option value="{{ $rental->id }}">{{ $rental->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('spec')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                            <button type="submit" name="save" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection