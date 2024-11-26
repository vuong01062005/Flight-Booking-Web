<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <header class="header">
        <a href="" class="header_logo">DINHVUONG</a>
        <nav class="header_nav">
            <a href="">Trang Chủ</a>
            <a href="">Giới Thiệu</a>
            <a href="">Liên Hệ</a>
            <div class="header_userInfo">
            @if (session('userID'))
                <div class="header_userInfo-logo">
                    <img src="{{ asset('storage/' . session('avatar')) }}" alt="Avatar" />
                    <p>{{ session('firstName') }} {{ session('lastName') }}</p>
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
                <div class="header_userInfo-info">
                    <a href="{{ route('edit_profile') }}">
                        <i class="fa-solid fa-user"></i>
                        <label>Chỉnh sửa hồ sơ</label>
                    </a>
                    <a href="transaction_list.php">
                        <i class="fa-solid fa-table-list"></i>
                        <label>Danh sách giao dịch</label>
                    </a>
                    <a href="my_bookings.php">
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
            </div>
        </nav>
    </header>
    @include('register')
    @include('login')
    <section class="home">
        <h2 class="home_title">Đi Khắp Việt Nam, Cùng Tôi.</h2>
        <form class="book__content-flight" method="get" action="{{ route('flight_list') }}">
            <div class="book__content-flight__row1">
                <div class="flight__row1-setTicket">
                    <div class="flight__row1-setTicket-age">
                        <div class="row1-setTicket-age-main">
                            <i class="fa-solid fa-user-group"></i>
                            <label class="flight__row1-setTicket-countAdult">1</label>
                            <input type="hidden" name="countAdult" id="countAdult" value="1">
                            <p> Người lớn, </p>
                            <label class="flight__row1-setTicket-countChild">0</label>
                            <input type="hidden" name="countChild" id="countChild" value="0">
                            <p> Trẻ em, </p>
                            <label class="flight__row1-setTicket-countInfant">0</label>
                            <input type="hidden" name="countInfant" id="countInfant" value="0">
                            <p> Em bé</p>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="row1-setTicket-age-list">
                            <div class="row1-setTicket-age-list-title">
                                <p>Số khách hàng</p>
                                <i class="x fa-solid fa-xmark"></i>
                            </div>
                            <div class="row1-setTicket-age-list-ageS">
                                <div class="setTicket-age-list-ageS-adult">
                                    <div class="list-ageS-adult-labelAdult">
                                        <i class="fa-solid fa-person"></i>
                                        <p>Người lớn<br></p>
                                    </div>
                                    <div class="list-ageS-adult-calcuAdult">
                                        <label id="subAdult">--</label>
                                        <label id="numberAdult">1</label>
                                        <label id="sumAdult">+</label>
                                    </div>
                                </div>
                                <div class="setTicket-age-list-ageS-child">
                                    <div class="list-ageS-child-labelChild">
                                        <i class="fa-solid fa-child-dress"></i>
                                        <p>Trẻ em<br></p>
                                    </div>
                                    <div class="list-ageS-child-calcuChild">
                                        <label id="subChild">--</label>
                                        <label id="numberChild">0</label>
                                        <label id="sumChild">+</label>
                                    </div>
                                </div>
                                <div class="setTicket-age-list-ageS-infant">
                                    <div class="list-ageS-infant-labelInfant">
                                        <i class="fa-solid fa-baby"></i>
                                        <p>Em bé<br></p>
                                    </div>
                                    <div class="list-ageS-infant-calcuInfant">
                                        <label id="subInfant">--</label>
                                        <label id="numberInfant">0</label>
                                        <label id="sumInfant">+</label>
                                    </div>
                                </div>
                                <div class="setTicket-age-list-ageS-done">Done</div>
                            </div>
                        </div>
                    </div>
                    <select name="chairType" id="chairType">
                        <option value="Economy Class">Economy Class</option>
                        <option value="Prenium Economy">Prenium Economy</option>
                        <option value="Business Class">Business Class</option>
                    </select>
                </div>
            </div>
            <div class="book__content-flight__row2">
                <div class="content-flight__row2-address">
                    <div class="flight__row2-address-from">
                        <p>Từ</p>
                        <div class="flight__row2-address-from-inputFrom">
                            <i class="fa-solid fa-plane-departure"></i>
                            <div class="flight__row2-address-from-inputFrom-date">
                                <select name="from" id="">
                                    <option value="HAN">Sân bay Nội Bài ( HAN )</option>
                                    <option value="SGN">Sân bay Tân Sơn Nhất ( SGN )</option>
                                    <option value="DAD">Sân bay Đà Nẵng ( DAD )</option>
                                    <option value="VDO">Sân bay Vân Đồn ( VDO )</option>
                                    <option value="HPH">Sân bay Cát Bì ( HPH )</option>
                                    <option value="VII">Sn bay Vinh ( VII )</option>
                                    <option value="HUI">Sân bay Phú Bài ( HUI )</option>
                                    <option value="CXR">Sân bay Cam Ranh ( CXR )</option>
                                    <option value="DLI">Sân bay Liên Khương ( DLI )</option>
                                    <option value="UIH">Sân bay Phù Cát ( UIH )</option>
                                    <option value="VCA">Sân bay Cần Thơ ( VCA )</option>
                                    <option value="PQC">Sân bay Phú Quốc ( PQC )</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flight__row2-address-to">
                        <p>Đến</p>
                        <div class="flight__row2-address-to-inputTo">
                            <i class="fa-solid fa-plane-arrival"></i>
                            <div class="flight__row2-address-to-inputTo-date">
                                <select name="to" id="">
                                <option value="HAN">Sân bay Nội Bài ( HAN )</option>
                                    <option value="SGN">Sân bay Tân Sơn Nhất ( SGN )</option>
                                    <option value="DAD">Sân bay Đà Nẵng ( DAD )</option>
                                    <option value="VDO">Sân bay Vân Đồn ( VDO )</option>
                                    <option value="HPH">Sân bay Cát Bì ( HPH )</option>
                                    <option value="VII">Sn bay Vinh ( VII )</option>
                                    <option value="HUI">Sân bay Phú Bài ( HUI )</option>
                                    <option value="CXR">Sân bay Cam Ranh ( CXR )</option>
                                    <option value="DLI">Sân bay Liên Khương ( DLI )</option>
                                    <option value="UIH">Sân bay Phù Cát ( UIH )</option>
                                    <option value="VCA">Sân bay Cần Thơ ( VCA )</option>
                                    <option value="PQC">Sân bay Phú Quốc ( PQC )</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-flight__row2-date">
                    <div class="flight__row2-date-departureDate">
                        <p>Ngày đi</p>
                        <input type="date" name="departure" id="" class="flight__row2-date-departureDate-inputDepar">
                    </div>
                    <div class="flight__row2-date-returnDate">
                        <div class="flight__row2-date-returnDate-icon">
                            <input type="checkbox" name="return-check" id="returnCheck">
                            <label>Khứ hồi</label>
                        </div>
                        <input type="date" name="return_date" id="return_date" disabled>
                    </div>
                </div>
                <div class="content-flight__row2-search">
                    <button type="submit" class="flight__row2-search-iconSearch" onclick="getnumberTicket()">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>
    </section>


    
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>