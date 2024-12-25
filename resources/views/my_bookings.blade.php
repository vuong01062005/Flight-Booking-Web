@php
    use App\Models\FlightList;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt chỗ của tôi</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/my_bookings.css') }}">
</head>
<body class="bg-light">
    @include('elements.header')

    <div class="container">
        <div class="container_header">
            <h2>Đặt chỗ</h2>
            <div>
                <a href="">Trang chủ </a>
                <span> &gt;&gt; </span>
                <a href="#"> Đặt chỗ của tôi</a>
            </div>
        </div>  

        <div class="container_intro">
            <h1>Du lịch dễ dàng</h1>
            <p>Đổi lịch dễ như trở bàn tay. <a href="#">Tìm hiểu thêm</a></p>
        </div>

        <div class="container_content">
            <h2>Vé điện tử</h2>

            @if (count($myBookings) > 0)
                @foreach ($myBookings as $a)
                <div class="container_content-ticket">
                    <div class="container_content-ticket-header">
                        <div class="container_content-ticket-headerLeft">
                            <i class="fa-solid fa-plane"></i>
                            <p>{{ $a->departure_city }}</p>
                            <i class="fa-solid fa-arrow-right-long"></i>
                            <p>{{ $a->arrival_city }}</p>
                        </div>
                        <p class="container_content-ticket-header-status">{{ $a->status }}</p>
                    </div>
                    <p>Mã đặt chỗ: {{ $a->booking_code }}</p>
                    <label class="container_content-ticketDetail container_content-ticketDetail{{ $a->id }}" onclick="showDetail({{ $a->id }})">Xem chi tiết</label>
                    @foreach ($tickets as $ticketGroup)
                        @foreach ($ticketGroup as $ticket)
                            @if ($ticket['id_contact'] == $a->id)
                            @php
                                $FlightList = new FlightList();
                                $flight = $FlightList->getFlightByCode($ticket['flight_code'])->toArray();
                            @endphp
                            <div class="container_content-ticket-content container_content-ticket-content{{ $a->id }}">
                                <div class="container_content-ticket-content-header">
                                    <p>{{ $flight['flight_date'] }}</p>
                                    @if ($ticket['return_date'] == 1)
                                        <p class="return">Chuyến bay về</p>
                                    @else
                                    <p>Chuyến bay đi</p>
                                    @endif
                                </div>
                                <div class="container_content-ticket-content-info">
                                    <div>
                                        <p><strong>{{ $ticket['title'] }} {{ $ticket['first_name'] }} {{ $ticket['last_name'] }}</strong></p>
                                        <p><strong>Ngày sinh:</strong> {{ $ticket['birthday'] }}</p>
                                        <p><strong>Quốc tịch:</strong> {{ $ticket['nationality'] }}</p>
                                    </div>
                                    <div>
                                        <p><strong>Mã chuyến bay:</strong> {{ $flight['flight_code'] }}</p>
                                        <p><strong>Thời gian:</strong> {{ $flight['departure_time'] }} - {{ $flight['arrival_time'] }}</p>
                                        <p><strong>Loại ghế:</strong> {{ $ticket['customer_type'] }} - {{ $ticket['chair_number'] }}</p>
                                    </div>
                                </div>
                                <div class="container_content-ticket-content-link">
                                    <a href="{{ route('changeTicket', ['id'=>$ticket['id'], 'date'=>$flight['flight_date'] ]) }}">Đổi vé</a>
                                    <a onclick="cancelTicket({{ $ticket['id'] }}, {{ session('userID')}})">Hủy vé</a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endforeach
                    <i class="fa-solid fa-angle-up container_content-ticketUp container_content-ticketUp{{ $a->id }}" onclick="closeDetail({{ $a->id }})"></i>
                </div>
                @endforeach
            @else
            <div class="container_content-empty">
                <img src="https://img.icons8.com/ios-filled/50/000000/sleeping-in-bed.png">
                <p>Không tìm thấy đặt chỗ</p>
                <p>Mọi chỗ bạn đặt sẽ được hiển thị tại đây. Hiện bạn chưa có bất kỳ đặt chỗ nào, hãy đặt trên trang chủ ngay!</p>
            </div>
            @endif
        </div>

        <div class="container_transaction-history">
            <h2>Lịch sử giao dịch</h2>
            <a href="">Xem Lịch sử giao dịch của bạn</a>
        </div>
    </div>

    
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function cancelTicket(id, id_account) {
            if (confirm('Xác nhận hủy chuyến bay?')) {
                $.ajax({
                    url: '/cancel-ticket/' + id,
                    method: 'POST',
                    data: {
                        id: id,
                        id_account: id_account,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        }
                    }
                })
            } else {
                alert('Đã hủy thao tác!');
            }
        }
        function showDetail(a) {
            document.querySelectorAll('.container_content-ticket-content' + a).forEach(content => content.style.display = 'flex');
            document.querySelector('.container_content-ticketUp' + a).style.display = 'flex';
            document.querySelector('.container_content-ticketDetail' + a).style.display = 'none';
        }

        function closeDetail(a) {
            document.querySelectorAll('.container_content-ticket-content' + a).forEach(content => content.style.display = 'none');
            document.querySelector('.container_content-ticketUp' + a).style.display = 'none';
            document.querySelector('.container_content-ticketDetail' + a).style.display = 'flex';
        }
    </script>
</body>

</html>

