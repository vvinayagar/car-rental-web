@extends('layouts.app')

@section('content')

    <div class="container my-5">
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="row g-0">
                        <div class="col-md-5">
                            {{-- <img class="img img-thumbnail" src="{{ asset('images/' . $imgPath) }}" /> --}}
                            <img src="{{ asset('images/' . json_decode($rental->images)[0]) }}"
                                class="img-fluid rounded-start" alt="Product Image">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h4 class="card-title">{{ $rental->brand->name }} {{ $rental->name }}</h4>
                                <p class="card-text text-muted">Short description about the product goes here. Mention
                                    highlights, features, or usage.</p>

                                <form method="POST" action="{{ route("cart.add", ['rental' => $rental]) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="plan" class="form-label">Plan</label>
                                        <select class="form-select" id="plan" name="plan">
                                            @foreach ($rental->plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($rental->plans as $plan)
                                            <input type="hidden" name="hid-plan-{{ $plan->id }}"
                                                value="{{ json_encode($plan) }}" />
                                        @endforeach
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Period</label>
                                        <div class="row">
                                            <div class="col">
                                                <label for="startDate" class="form-label">Start Date</label>
                                                <input name="startDate" id="startDate" class="form-control" type="date"
                                                    min="{{ \Carbon\Carbon::now()->addDays(2)->format('Y-m-d') }}" />
                                            </div>
                                            <div class="col">
                                                <label for="startDate" class="form-label">End Date</label>
                                                <input name="endDate" id="endDate" class="form-control" type="date"
                                                   min="{{ \Carbon\Carbon::now()->addDays(2)->format('Y-m-d') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <select class="form-select" id="color" name="color">
                                        <option selected>Select color</option>
                                        <option value="red">Red</option>
                                        <option value="blue">Blue</option>
                                        <option value="green">Green</option>
                                    </select>
                                </div> --}}

                                    <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                                </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fs-5 fw-bold text-success">RM <span id="price">{{ $rental->plans->first()->price }}</span> per
                                            {{ $rental->plans->first()->days }} day(s)</span>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const startInput = document.getElementById('startDate');
            const endInput = document.getElementById('endDate');

            // Set min date to today + 2
            const today = new Date();
            const minStartDate = new Date(today.setDate(today.getDate() + 2));
            const formattedMinStart = minStartDate.toISOString().split('T')[0];
            startInput.min = formattedMinStart;

            // Set default value to min start
            startInput.value = formattedMinStart;

            // Set end date when start is selected
            startInput.addEventListener('change', function () {
                const startDate = new Date(this.value);
                const formattedStart = startDate.toISOString().split('T')[0];

                // Set end date min to selected start date
                endInput.min = formattedStart;

                // If end date is before start date, reset it
                if (!endInput.value || new Date(endInput.value) < startDate) {
                    endInput.value = formattedStart;
                }
            });

            // Trigger once on load to sync end field
            startInput.dispatchEvent(new Event('change'));
        });
        </script>
@endsection
