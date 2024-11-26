<section class="controller">
    <div class="controller_ticket">
        <div class="controller_ticket-title" onclick="openItem('controller_ticket nav')">
            <i class="fa-solid fa-ticket"></i>
            <p>Chuyến bay</p>
        </div>
        <nav>
            <a href="{{ route('add-flight-form') }}">Thêm mới</a>
            <a href="{{ route('flight-list-form') }}">Danh sách</a>
        </nav>
    </div>
    <div class="controller_customer" onclick="openItem('controller_customer nav')">
        <div class="controller_customer-title">
            <i class="fa-solid fa-person"></i>
            <p>Khách hàng</p>
        </div>
        <nav>
            <a href="">Tài khoản</a>
            <a href="{{ route('admin-customer-contact') }}">Thông tin liên hệ</a>
            <a href="{{ route('admin-customer-ticket') }}">Thông tin vé</a>
        </nav>
    </div>
    <div class="controller_statistical" onclick="openItem('controller_statistical nav')">
        <div class="controller_statistical-title">
            <i class="fa-solid fa-person"></i>
            <p>Thống kê</p>
        </div>
        <nav>
            <a href="">Doanh</a>
            <a href="{{ route('admin-customer-contact') }}">Thông tin liên hệ</a>
            <a href="{{ route('admin-customer-ticket') }}">Thông tin vé</a>
        </nav>
    </div>
</section>
<script>
    function openItem(a) {
        var b = document.querySelector('.' + a)
        if (b.style.display === 'flex') {
            b.style.display = 'none'
        } else {
            b.style.display = 'flex'
        }
    }
</script>