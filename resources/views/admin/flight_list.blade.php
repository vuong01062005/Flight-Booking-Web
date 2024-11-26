@php
    use App\Models\FlightList;
    $FlightList = new FlightList();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>
    @include('admin.header')
    <section class="container">
        @include('admin.sidebar')
        <section class="main">
            <div class="main_header">
                <h3>Thông tin chuyến bay</h3>
            </div>
            <div class="layout_table">
                <h3>Danh sách chuyến bay</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Mã chuyến bay</th>
                            <th>Điểm đi</th>
                            <th>Điểm đến</th>
                            <th>Thời gian cất cánh</th>
                            <th>Thời gian hạ cánh</th>
                            <th>Ngày bay</th>
                            <th>Hãng bay</th>
                            <th>Tên máy bay</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $flights = $FlightList->showFlightListPage(1);
                        @endphp
                        @foreach ($flights as $flight)
                            <tr>
                                <td>{{ $flight->flight_code }}</td>
                                <td>{{ $flight->departure_cityName }}</td>
                                <td>{{ $flight->arrival_cityName }}</td>
                                <td>{{ $flight->departure_time }}</td>
                                <td>{{ $flight->arrival_time }}</td>
                                <td>{{ $flight->flight_date }}</td>
                                <td>{{ $flight->airline }}</td>
                                <td>{{ $flight->flight_name }}</td>
                                <td><a href="">Chỉnh sửa</a></td>
                                <td><a href="">Xóa</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <footer class="layout_table-footer">
                    <p>
                        Showing {{ $flights->firstItem() }} - {{ $flights->lastItem() }} of {{ $flights->total() }} items
                    </p>
                    <ul>
                        <li>
                            @if ($flights->onFirstPage())
                                <a><i class="fa fa-chevron-left"></i></a>
                            @else
                                <a href="{{ $flights->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                            @endif
                        </li>
                        @php
                            $currentPage = $flights->currentPage();
                            $lastPage = $flights->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);
                        @endphp
                        @if ($startPage > 1)
                            <li><a href="{{ $flights->url(1) }}">1</a></li>
                            @if ($startPage > 2)
                                <li><span>...</span></li>
                            @endif
                        @endif
                
                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <li>
                                <a href="{{ $flights->url($i) }}" class="{{ $currentPage == $i ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor
                        @if ($endPage < $lastPage)
                            @if ($endPage < $lastPage - 1)
                                <li><span>...</span></li>
                            @endif
                            <li><a href="{{ $flights->url($lastPage) }}">{{ $lastPage }}</a></li>
                        @endif
                        <li>
                            @if ($flights->hasMorePages())
                                <a href="{{ $flights->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                            @else
                                <span><i class="fa fa-chevron-right"></i></span>
                            @endif
                        </li>
                    </ul>
                </footer>
            </div>
        </section>
    </section>

    <section id="draggable" class="draggable">
        Kéo tôi đi xung quanh!
    </section>
</body>
</html>