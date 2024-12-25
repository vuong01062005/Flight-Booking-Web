<link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
<style>
   /* Căn giữa tiêu đề và đoạn giới thiệu */
   a {
    text-decoration: none;
   }
    .contact-header {
        text-align: center;
        margin-top: 20px;
        font-size: 32px;
        font-weight: bold;
        color: #333;
    }

    .contact-subtext {
        text-align: center;
        font-size: 18px;
        color: #555;
        margin-bottom: 30px;
    }

    /* Chia layout thành 2 cột */
    .contact-container {
        display: flex;
        justify-content: space-between;
        align-items: stretch;
        max-width: 1200px;
        margin: 0 auto;
        gap: 30px; /* Khoảng cách giữa các cột */
        padding: 20px;
    }

    /* Bên trái: Google Map */
    .map-container {
        flex: 1; /* Chiếm 1 phần */
        text-align: center;
    }

    .map-container iframe {
        border: none;
        width: 100%;
        height: 500px; /* Tăng chiều cao bản đồ */
        border-radius: 8px; /* Bo góc nhẹ cho bản đồ */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Thêm hiệu ứng đổ bóng */
    }

    /* Bên phải: Thông tin liên hệ */
    .contact-info {
        flex: 1.2; /* Chiếm 1.2 phần để rộng hơn */
        font-size: 16px;
        line-height: 1.8;
        color: #333;
        padding: 10px;
        border-radius: 8px;
        background-color: #f9f9f9; /* Nền sáng cho phần thông tin */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng */
    }

    /* Danh sách liên hệ */
    .contact-info ul {
        padding-left: 20px;
        list-style-type: disc;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .contact-container {
            flex-direction: column; /* Xếp dọc trên màn hình nhỏ */
            gap: 20px;
        }

        .map-container iframe {
            height: 300px;
        }
    }



</style>
@include('elements.header')
<div class="contact-page">
    <h1 class="contact-header">Contact Us</h1>
    <p class="contact-subtext">Chúng tôi luôn hỗ trợ, dù bạn ở bất cứ đâu!</p>
    <!-- Đây là container chính để áp dụng Flexbox -->
    <div class="contact-container">
        <!-- Phần bản đồ -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.546625609968!2d105.8440834138998!3d21.024638895003624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac7696b68729%3A0x46343b2b3365a8a!2zQ29uZyB0eSBDUCBCw6EgS2kgUGjDoG5nIG5hbiBUw6EgSOG7jW5jIG5rD0gQ2jDoG5nIGzhu65n!5e0!3m2!1svi!2s!4v1694365239799!5m2!1svi!2s" 
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        
        <!-- Phần thông tin liên hệ -->
        <div class="contact-info">
            <h2>Hệ thống văn phòng và chi nhánh HV trên toàn quốc</h2>
            <p><strong>Trụ sở chính:</strong></p>
            <p>Công ty CP Công nghệ HV - Tầng 6, 266 Đội Cấn, Phường Liễu Giai, Quận Ba Đình, TP Hà Nội</p>
            <p><strong>Khu vực Miền Bắc:</strong></p>
            <ul>
                <li>50-6, Đường 5, Phố Bạch Đằng, Nam Thành, Ninh Bình</li>
                <li>170 Tôn Đức Thắng, Lam Sơn, Lê Chân, Hải Phòng</li>
                <li>79c, Tổ 24, Đường Xuân Hòa, Phan Đình Phùng, Thái Nguyên</li>
                <li>30 Ngô Miễn Thiệu, Tiên An, Bắc Ninh</li>
                <li>50 Ngõ Khu đô thị Petro Thăng Long, Thái Bình</li>
            </ul>
            <p><strong>Khu vực Miền Trung:</strong></p>
            <ul>
                <li>50-6, Đường 5, Phố Bạch Đằng, Nam Thành, Quảng Bình</li>
                <li>170 Tôn Đức Thắng, Lam Sơn, Lê Chân, Quảng Trị</li>
                <li>79c, Tổ 24, Đường Xuân Hòa, Phan Đình Phùng, Thừa Thiên - Huế</li>
                <li>30 Ngô Miễn Thiệu, Tiên An, Quảng Nam</li>
                <li>50 Ngõ Khu đô thị Petro Thăng Long, Quảng Ngãi</li>
                <li>470 D.Trần Đại Nghĩa, Hòa Hải, Ngũ Hành Sơn, Đà Nẵng</li>
            </ul>
            <p><strong>Khu vực Miền Nam:</strong></p>
            <ul>
                <li>50-6, Đường 5, Phố Bạch Đằng, Nam Thành, Bà Rịa - Vũng Tàu</li>
                <li>170 Tôn Đức Thắng, Lam Sơn, Lê Chân, Bến Tre</li>
                <li>79c, Tổ 24, Đường Xuân Hòa, Phan Đình Phùng, Long An</li>
                <li>30 Ngô Miễn Thiệu, Tiên An, Trà Vinh</li>
                <li>50 Ngõ Khu đô thị Petro Thăng Long, Kiên Giang</li>
                <li>470 D.Trần Đại Nghĩa, Hòa Hải, Ngũ Hành Sơn, Cà Mau</li>
            </ul>
        </div>
    </div>
</div>

@include('elements.footer')
