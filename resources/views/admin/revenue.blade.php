@php
    use App\Models\Payment;
    $Payment = new Payment();

    $payments = $Payment->getPaymentonYear('2024');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doanh Thu</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @include('admin.header')
    <section class="container">
        @include('admin.sidebar')
        <section class="main">
            <div class="main_header">
                <h3>Thông tin chuyến bay</h3>
            </div>
            <div class="revence_content">
                <h3>Doanh Thu</h3>
                @foreach ($payments as $pay)
                    <p>{{ $pay->month }}: {{ $pay->total_amount }}</p>
                @endforeach
                <canvas id="myChart" width="300" height="150"></canvas>
            </div>
        </section>
    </section>


    <script>
        var labels = <?php echo json_encode($payments->pluck('month')); ?>;
        var salesData = <?php echo json_encode($payments->pluck('total_amount')); ?>;

        var ctx = document.getElementById('myChart').getContext('2d');
    
        var data = {
            labels: labels,
            datasets: [{
                label: 'Số lượng bán hàng',
                data: salesData,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };
    
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>