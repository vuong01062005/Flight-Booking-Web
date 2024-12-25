<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp Tiền</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/my_wallet.css') }}">
</head>
<body>
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
        <div class="container_nav">
            <p>Số tiền hiện tại: <span>{{ session('wallet')}} VND</span></p>
            <div class="container_nav-btn">
                <button>Nạp tiền</button>
                <button>Rút tiền</button>
            </div>
        </div>
        <div class="container_payment-options">
            <img src="https://cdn.garenanow.com/webmain/static/payment_center/vn/menu/vnshopeepay_pc.png" alt="SPay" data-name="Ví Shoppe Pay" class="active">
            <img src="https://cdn-gop-garenanow-com.obs.ap-southeast-3.myhuaweicloud.com/cdn.garenanow.com/webmain/static/payment_center/vn/menu/QR-PAY.png" alt="Garena Số" data-name="QR Pay">
            <img src="https://cdn-gop-garenanow-com.obs.ap-southeast-3.myhuaweicloud.com/cdn.garenanow.com/webmain/static/payment_center/vn/menu/Mobile%20app%20%7C%20205214.jpeg" alt="QR Pay" data-name="Ngân hàng">
        </div>
        <input type="hidden" id="method" name="method" value="Ví Shoppe Pay">

        <div class="container_title">Thanh toán qua <span>Ví Shoppe Pay</span></div>

        <div class="container_content">
            <div class="container_content-left">
                <h3>Giá</h3>
                <nav>
                    <div>
                        <input type="radio" name="amount" value="100.000">
                        <p>100.000 ₫</p>
                    </div>
                    <div>
                        <input type="radio" name="amount" value="200.000">
                        <p>200.000 ₫</p>
                    </div>
                    <div>
                        <input type="radio" name="amount" value="500.000">
                        <p>500.000 ₫</p>
                    </div>
                    <div>
                        <input type="radio" name="amount" value="1.000.000">
                        <p>1.000.000 ₫</p>
                    </div>
                    <div>
                        <input type="radio" name="amount" value="2.000.000">
                        <p>2.000.000 ₫</p>
                    </div>
                    <div>
                        <input type="radio" name="amount" value="5.000.000">
                        <p>5.000.000 ₫</p>
                    </div>
                </nav>
            </div>
            <div class="container_content-right empty">Vui lòng chọn mệnh giá tương ứng ở bên trái để thanh toán</div>
            <div class="container_content-right qr">
                <p>Quét mã QR ở dưới để thanh toán</p>
                <img src="https://th.bing.com/th/id/OIP.3PS24iiu-A3RpY9MdvBxKAHaHa?w=187&h=187&c=7&r=0&o=5&dpr=1.4&pid=1.7" alt="">
                <p>Mã QR sẽ hết hạn sau 5 phút. Vui lòng hoàn tất thanh toán trong 5 phút</p>
                <button class="container_content-right-btn">Thanh toán hoàn tất</button>
            </div>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const titleSpan = document.querySelector('.container_title span');
        const images = document.querySelectorAll('.container_payment-options img');

        images.forEach(img => {
            img.addEventListener('click', function() {
                images.forEach(img => img.classList.remove('active'));
                
                this.classList.add('active');
                
                const paymentName = this.getAttribute('data-name');
                document.getElementById('method').value = paymentName;
                titleSpan.textContent = paymentName;

                document.querySelectorAll('input[type="radio"]').forEach(radio => {
                    radio.checked = false;
                });
                document.querySelectorAll('.container_content-left nav div').forEach(div => div.classList.remove('active'));
                document.querySelector('.container_content-right.empty').style.display = 'flex';
                document.querySelector('.container_content-right.qr').style.display = 'none';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const radioDivs = document.querySelectorAll('.container_content-left nav div');

            radioDivs.forEach(div => {
                const radio = div.querySelector('input[type="radio"]');
                
                radio.addEventListener('change', function() {
                    radioDivs.forEach(div => div.classList.remove('active'));
                    
                    if (this.checked) {
                        div.classList.add('active');
                    }

                    document.querySelector('.container_content-right.empty').style.display = 'none';
                    document.querySelector('.container_content-right.qr').style.display = 'flex';
                });
            });
        });

        $(document).ready(function() {
            $('.container_content-right-btn').click(function() {
                var ID_account = "{{ session('userID') }}";
                var amount = $('input[name="amount"]:checked').val();
                var method = $('#method').val();
                console.log(ID_account, amount, method);
                

                $.ajax({
                    url: "/add-payment",
                    method: 'POST',
                    data: {
                        ID_account: ID_account,
                        amount: amount,
                        method: method,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Thanh toán hoàn tất. Vui lòng kiểm tra lại số tiền của bạn.');
                            location.reload();
                        } else {
                            console.log(response.message);
                        }
                    }
                })
            })
        })
    </script>
</body>
</html>
