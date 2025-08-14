@extends('layouts.app')

@section('content')

<form method="GET" onchange="this.form.submit()" class="mb-4 flex gap-2 items-center">
    <label for="year" class="font-semibold">Select Year:</label>
    <select name="year" id="year" onchange="this.form.submit()" class="border rounded p-2">
        @for ($y = date('Y'); $y >= date('Y') - 4; $y--)
            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                {{ $y }}
            </option>
        @endfor
    </select>
</form>

<canvas id="categoryMonthlyChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('categoryMonthlyChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($labels),
        datasets: @json(
            collect($datasets)->map(function ($d) {
                $d['backgroundColor'] = '#' . substr(md5($d['label']), 0, 6); // random color
                return $d;
            })
        ),
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Monthly Expenses by Category ({{ $year }})' }
        }
    }
});
</script>
@endsection