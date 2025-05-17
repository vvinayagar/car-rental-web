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
                                                <label for="endDate" class="form-label">End Date</label>
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
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="2">
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
{{--
<script>
    const blockedDates = {!! $blockedDatesJson !!}; // Dates fully booked
    const availableCount = @json($availableCountPerDate); // e.g., { "2025-05-18": 2, "2025-05-19": 4 }

    const inputStart = document.getElementById("startDate");
    const inputEnd = document.getElementById("endDate");

    // Show tooltip or availability
    function updateAvailabilityDisplay(date) {


        const available = {{ $rental->count }} - (availableCount[date] ?? 0);
        if (available <= 0) {
            alert("Date fully booked.");
            return false;
        } else {
            console.log(`${available} car(s) available on ${date}`);
        }
        return true;
    }

    // Remove duplicate listener
    inputStart.addEventListener("input", function () {
        if (blockedDates.includes(this.value)) {
            alert("Selected date is not allowed (fully booked).");
            this.value = "";
        } else {
            updateAvailabilityDisplay(this.value);
        }
    });

    inputEnd.addEventListener("input", function () {
        if (blockedDates.includes(this.value)) {
            alert("Selected end date is not allowed (fully booked).");
            this.value = "";
        } else {
            updateAvailabilityDisplay(this.value);
        }
    });
</script> --}}

<script>
    const blockedDates = {!! $blockedDatesJson !!}; // Fully blocked (100% booked)
    const availableCount = @json($availableCountPerDate); // e.g., { "2025-05-18": 2 }
    const maxCars = {{ $rental->count }}; // Total available cars

    const inputStart = document.getElementById("startDate");
    const inputEnd = document.getElementById("endDate");
    const quantityInput = document.getElementById("quantity");
    const form = document.querySelector("form");

    // Get list of dates between two dates
    function getDatesInRange(start, end) {
        const dates = [];
        let current = new Date(start);
        const last = new Date(end);
        while (current <= last) {
            dates.push(current.toISOString().split('T')[0]);
            current.setDate(current.getDate() + 1);
        }
        return dates;
    }

    // Main check function
    function checkAvailability() {
        const startDate = inputStart.value;
        const endDate = inputEnd.value;
        const quantity = parseInt(quantityInput.value || "1");

        if (!startDate || !endDate || isNaN(quantity)) return true;

        const dates = getDatesInRange(startDate, endDate);
        let conflictDates = [];

        for (let date of dates) {
            const booked = availableCount[date] ?? 0;
            const remaining = maxCars - booked;

            if (quantity > remaining) {
                conflictDates.push(`${date} (only ${remaining} left)`);
            } else {
                console.log(`${remaining} car(s) available on ${date}`);
            }
        }

        if (conflictDates.length > 0) {
            alert("Not enough cars on:\n" + conflictDates.join("\n"));
            return false;
        }

        return true;
    }

    // Block date input if in blockedDates
    function handleDateInput(input) {
        if (blockedDates.includes(input.value)) {
            alert("Selected date is not allowed (fully booked).");
            input.value = "";
        } else {
            checkAvailability();
        }
    }

    inputStart.addEventListener("input", () => handleDateInput(inputStart));
    inputEnd.addEventListener("input", () => handleDateInput(inputEnd));
    quantityInput.addEventListener("input", checkAvailability);

    // Prevent form submission if invalid
    form.addEventListener("submit", function(e) {
        if (!checkAvailability()) {
            e.preventDefault();
        }
    });
</script>


{{-- <script>
       const blockedDates = {!! $blockedDatesJson !!};
    const inputStart = document.getElementById("startDate");
    const inputEnd = document.getElementById("endDate");

    inputStart.addEventListener("input", function () {
        if (blockedDates.includes(this.value)) {
            alert("Selected date is not allowed.");
            this.value = ""; // Clear the invalid date
        }
    });

    inputStart.addEventListener("input", function () {
        if (blockedDates.includes(this.value)) {
            alert("Selected date is not allowed.");
            this.value = ""; // Clear the invalid date
        }
    });
</script> --}}
@endsection
