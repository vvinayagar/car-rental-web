@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Plan') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('plan.update', ['plan' => $plan]) }}" class="form" type="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" placeholder="Name" required autocomplete="name"
                                        class="form-control" value="{{$plan->name}}" />
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Days</label>
                                    <input type="number" name="days" placeholder="Days" required autocomplete="days"
                                        class="form-control" value="{{$plan->days}}" />
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Price</label>
                                    <input type="number" name="price" placeholder="Price" required autocomplete="price" class="form-control" value="{{$plan->price}}" />
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="spec">Rental Type</label>
                                   <select id="rental" name="rental" placeholder="Rental" required class="form-control">
                                        @foreach ($rentals as $rental)
                                            <option value="{{ $rental->id }}" @if($rental->id == $plan->rental->id) selected @endif >{{ $rental->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('spec')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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