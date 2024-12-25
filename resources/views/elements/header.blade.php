<header class="header">
    <a href="{{ route('home') }}" class="header_logo">Dinh Vuong</a>
    <nav class="header_nav">
        <a href="{{ route('home') }}">Trang Chủ</a>
        <a href="{{ route('introduce') }}">Giới Thiệu</a>
        <a href="{{ route('contact') }}">Liên Hệ</a>
        <div class="header_userInfo">
        @if (session('userID'))
            <div class="header_userInfo-logo">
                <img src="{{ asset('storage/' . session('avatar')) }}" alt="Avatar" />
                <p>{{ session('firstName') }} {{ session('lastName') }}</p>
            </div>
            <div class="header_userInfo-info">
                <a href="{{ route('wallet', ['id'=>session('userID')]) }}">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <label>Ví của tôi</label>
                </a>
                <a href="{{ route('edit_profile', ['id' => session('userID')]) }}">
                    <i class="fa-solid fa-user"></i>
                    <label>Chỉnh sửa hồ sơ</label>
                </a>
                <a href="{{ route('transaction_list', ['id' => session('userID')]) }}">
                    <i class="fa-solid fa-table-list"></i>
                    <label>Danh sách giao dịch</label>
                </a>
                <a href="{{ route('my_bookings', ['id' => session('userID')]) }}">
                    <i class="fa-solid fa-chair"></i>
                    <label>Đặt chỗ của tôi</label>
                </a>
                <form method="get" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <label>Đăng xuất</label>
                    </button>
                </form>
            </div>
            <script>
                document.addEventListener('click', function(event) {
                    if (!document.querySelector('.header_userInfo-logo').contains(event.target)) {
                        document.querySelector('.header_userInfo-info').style.display = 'none';
                    }
                });
                document.querySelector('.header_userInfo-logo').addEventListener('click', function () {
                    document.querySelector('.header_userInfo-info').style.display = 'block';
                });
            </script>
        @else
            <a onclick="showModalRegister()">Đăng Ký</a>
            <a onclick="openModal()">Đăng Nhập</a>
        @endif
        </div>
    </nav>
</header>