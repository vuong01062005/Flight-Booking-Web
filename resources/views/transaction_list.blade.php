<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giao dịch của tôi</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/transaction_list.css') }}">
</head>
<body>
    @include('elements.header')

    <div class="container">
        <div class="container_content">
            <div>
                <h2>Lịch sử giao dịch</h2>
                <div class="container_content-link">
                    <a href="index.php">Trang chủ</a>
                    <span> &gt; </span>
                    <a href="#">Giao dịch của tôi</a>
                </div>     
            </div>       
            
            <div class="container_content-header">
                <span>Xem tất cả vé máy bay và phiếu thanh toán trong <a href="my_bookings.php">Đặt chỗ của tôi</a></span>
            </div>
            
            <div class="container_content-filters">
                <button class="filter-btn active" data-range="90-days">90 ngày qua</button>
                <button class="filter-btn" data-range="10-2024">Tháng 10 2024</button>
                <button class="filter-btn" data-range="9-2024">Tháng 9 2024</button>
                <button class="filter-btn" data-range="custom">Ngày tùy chọn</button>
            </div>

            <div class="container_content-fromTo">
                <label for="start-date">Từ:</label>
                <input type="date" id="start-date">
                <label for="end-date">Đến:</label>
                <input type="date" id="end-date">
                <button id="apply-filter">Lọc</button>
            </div>

            <div id="container_content-results">
                @if (count($payments) <= 0)
                <div class="container_content-results-empty-box">
                    <img src="https://img.icons8.com/ios-filled/50/000000/sleeping-in-bed.png">
                    <p>Không tìm thấy giao dịch</p>
                    <p>
                        Không tìm thấy giao dịch cho sản phẩm bạn chọn. Đặt lại bộ lọc để xem tất cả giao dịch.
                    </p>
                </div>
                @else
                @foreach ($payments as $paymentGroup)
                @foreach ($paymentGroup as $payment)
                @foreach ($contacts as $contact)
                @if ($payment['contactID'] == $contact->id)
                <div class="container_content-results-true">
                    <div class="results_true-transaction">
                        <div class="results_true-transaction-header">
                            <span class="results_true-transaction-header-date">{{ $payment['created_at'] }}</span>
                            <div>
                                <p>{{ $contact->departure_city }}</p>
                                <i class="fa-solid fa-plane-departure"></i>
                                <p>{{ $contact->arrival_city }}</p>
                            </div>
                            <span class="results_true-transaction-header-method">{{ $payment['method'] }}</span>
                        </div>
                        <div class="results_true-transaction-details">
                            <p><strong>Mã đặt chỗ:</strong> {{ $contact->booking_code }}</p>
                            <p class="results_true-transaction-details-price"><strong>{{ $payment['amount'] }}</strong>&nbsp;VND</p>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @endforeach
                @endforeach
                @endif
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.filter-btn').click(function() {
                var date = $(this).data('range');
                var ID_account = "{{ session('userID') }}";

                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
    
                $.ajax({
                    url: "/filter-transactions/{{ session('userID') }}?date=" + date,
                    method: 'POST',
                    data: {
                        date: date,
                        ID_account: ID_account,
                        _token: '{{ csrf_token() }}'
                    }, 
                    success: function(response) {
                        if (response.status === 'success') {
                            var payments = response.payments;
                            var contacts = response.contacts;
                            $('#container_content-results').empty();

                            let hasData = payments.some(paymentGroup => paymentGroup.length > 0);
                            if (!hasData) {
                                $('#container_content-results').append(`
                                <div class="container_content-results-empty-box">
                                    <img src="https://img.icons8.com/ios-filled/50/000000/sleeping-in-bed.png">
                                    <p>Không tìm thấy giao dịch</p>
                                    <p>
                                        Không tìm thấy giao dịch cho sản phẩm bạn chọn. Đặt lại bộ lọc để xem tất cả giao dịch.
                                    </p>
                                </div>
                                `)
                            } else {
                                payments.forEach(paymentGroup => {
                                    if (paymentGroup.length > 0) {
                                        paymentGroup.forEach(payment => {
                                            contacts.forEach(contact => {
                                                if (payment['contactID'] == contact.id) {
                                                    $('#container_content-results').append(`
                                                    <div class="container_content-results-true">
                                                        <div class="results_true-transaction">
                                                            <div class="results_true-transaction-header">
                                                                <span class="results_true-transaction-header-date">${ payment['created_at'] }</span>
                                                                <div>
                                                                    <p>${ contact.departure_city }</p>
                                                                    <i class="fa-solid fa-plane-departure"></i>
                                                                    <p>${ contact.arrival_city }</p>
                                                                </div>
                                                                <span class="results_true-transaction-header-method">${ payment['method'] }</span>
                                                            </div>
                                                            <div class="results_true-transaction-details">
                                                                <p><strong>Mã đặt chỗ:</strong> ${ contact.booking_code }</p>
                                                                <p class="results_true-transaction-details-price"><strong>${ payment['amount'] }</strong>&nbsp;VND</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    `)
                                                }
                                            })
                                        })
                                    }
                                });
                            }
                        } else {
                            console.log(response.message);
                        }
                    }
                })
            });
        });
    </script>
</script>
</body>
</html>