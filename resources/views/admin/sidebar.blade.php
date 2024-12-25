<style>
    .controller {
        width: 100%;
        max-width: 250px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        font-family: Arial, sans-serif;
    }

    /* Các mục chính */
    .controller div {
        margin-bottom: 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        background-color: #fff;
        transition: 0.3s ease;
    }

    .controller div:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    /* Tiêu đề */
    .controller div .controller_ticket-title, 
    .controller div .controller_customer-title,
    .controller div .controller_statistical-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 15px;
        cursor: pointer;
        background-color: #f3f3f3;
        color: #333;
        font-size: 16px;
        font-weight: bold;
        border-bottom: 1px solid #e0e0e0;
    }

    .controller div i {
        font-size: 20px;
        color: #007bff;
        margin-right: 10px;
    }

    /* Menu liên kết */
    .controller nav {
        display: none;
        flex-direction: column;
        padding: 0 10px 10px 10px;
        background-color: #fff;
    }

    .controller nav a {
        display: block;
        padding: 8px 10px;
        margin: 5px 0;
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
        border-radius: 5px;
        transition: 0.3s ease;
    }

    .controller nav a:hover {
        background-color: #e9f5ff;
    }

    /* Mở menu */
    .controller_ticket.nav nav,
    .controller_statistical.nav nav,
    .controller_customer.nav nav {
        display: flex;
    }
</style>
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
            <a href="{{ route('admin-customer-account') }}">Tài khoản</a>
            <a href="{{ route('admin-customer-contact') }}">Thông tin liên hệ</a>
            <a href="{{ route('admin-customer-ticket') }}">Thông tin vé</a>
        </nav>
    </div>
    {{-- <div class="controller_statistical" onclick="openItem('controller_statistical nav')">
        <div class="controller_statistical-title">
            <i class="fa-solid fa-person"></i>
            <p>Thống kê</p>
        </div>
        <nav>
            <a href="{{ route('revenue') }}">Doanh thu</a>
        </nav>
    </div> --}}
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