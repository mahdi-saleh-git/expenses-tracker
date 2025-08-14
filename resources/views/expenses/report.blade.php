@extends('layouts.app')

@section('content')
 
<form method="GET" class="mb-4">
    <select name="type" onchange="this.form.submit()" class="border p-2 rounded">
        <option value="monthly" {{ $type == 'monthly' ? 'selected' : '' }}>Monthly</option>
        <option value="yearly" {{ $type == 'yearly' ? 'selected' : '' }}>Yearly</option>
        <option value="weekly" {{ $type == 'weekly' ? 'selected' : '' }}>Weekly</option>
    </select>
</form>

<canvas id="expensesChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('expensesChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Total Expenses (RM)',
                data: @json($data),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });
</script>

@endsection