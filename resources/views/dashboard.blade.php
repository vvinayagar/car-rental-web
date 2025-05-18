@extends('layouts.app')

@section('content')

    <div class="container mt-3">


 <h1 style="text-align: center;">Approval Status</h1>
    
    <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <div style="width: 400px; height: 400px;">
        <canvas id="approvalChart"></canvas>
    </div>
    </div>


        {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif






        </div>
    </div>
@endsection
@push('scripts')
<script >

    $(document).ready(function() {
       // Get the canvas element
const ctx = document.getElementById('approvalChart').getContext('2d');

// Data for the chart (you can replace these with your actual values)
const approvalData = {
    approve: {{$approved}},
    reject: {{ $rejected }},
    waiting: {{ $waiting }}
};

// Create the doughnut chart
const approvalChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Approve', 'Reject', 'Waiting'],
        datasets: [{
            data: [approvalData.approve, approvalData.reject, approvalData.waiting],
            backgroundColor: [
                '#4CAF50', // Green for Approve
                '#F44336', // Red for Reject
                '#FFC107'  // Yellow for Waiting
            ],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.raw || 0;
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = Math.round((value / total) * 100);
                        return `${label}: ${value} (${percentage}%)`;
                    }
                }
            }
        },
        cutout: '70%',
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
});
});

 
</script>
@endpush