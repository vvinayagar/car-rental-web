@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rental Laptops') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('rent.edit', ['id' => $rent->id]) }}" class="form" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <select id="username" name="username" placeholder="User Name" required
                                        class="form-control">
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if($rent->user_id == $user->id) selected  @endif >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="rental">Rental</label>
                                    <select id="rental" name="rental" placeholder="Rental" required
                                        class="form-control">
                                        @foreach ($rentals as $rental)
                                        <option value="{{ $rental->id }}" @if($rent->rental_model_id == $rental->id) selected @endif>{{ $rental->name }} - {{ $rental->spec }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('rental')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="plan">Plan</label>
                                    <select id="plan" name="plan" placeholder="Plan" required class="form-control">
                                        @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}" @if($rent->plan_id == $plan->id) selected @endif>{{ $plan->name }} - {{ $plan->days }} - {{
                                            $plan->price }}</option>
                                        @endforeach
                                    </select>
                                    @error('plan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="details" placeholder="Details" required autocomplete="details"
                                        class="form-control">{{ $rent->details }}</textarea>
                                    @error('details')
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