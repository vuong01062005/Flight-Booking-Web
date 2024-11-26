<?php
use App\Models\FlightList;
use App\Http\Controllers\HomeController;

$FlightList = new FlightList();
$home_controller = new HomeController();
$flight_listNameCity = $FlightList->getNameCity($from, $to);
$flight_lists = $FlightList->get_flights($from, $to, $departure, $chairType);
$flight_listsReturn = $FlightList->get_flights($to, $from, $return_date, $chairType);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flight List</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flight_list.css') }}">
</head>
<body>
    <header class="header">
        <a href="" class="header_logo">DINHVUONG</a>
        <nav class="header_nav">
            <a href="">Trang Chủ</a>
            <a href="">Giới Thiệu</a>
            <a href="">Liên Hệ</a>
            <div class="header_userInfo">
            @if ($userID)
                <div class="header_userInfo-logo">
                    <img src="{{ asset('storage/' . $avatar) }}" alt="Avatar" />
                    <p>{{ $firstName }} {{ $lastName }}</p>
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
                    <a href="edit_profile.php">
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
                    <form method="post" action="{{ route('logout') }}">
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

    <div class="label_list">Danh sách chuyến bay</div>

    <section class="list">
        <div class="list_container">
            <div class="myFlight">
                <div class="myFlight_header">
                    <i class="fa-solid fa-jet-fighter"></i>
                    <p>Chuyến bay của bạn</p>
                </div>
                <div class="myFlight_dep selected_flight">
                    <div class="myFlight_dep-header">
                        <label><span>1</span></label>
                        <div>
                            <p>{{ $home_controller->formatVietnameseDate($departure) }}</p>
                            @foreach ($flight_listNameCity as $item)
                                <p>{{ $item->departure_cityName }} <i class="fa-solid fa-arrow-right-long"></i> {{ $item->arrival_cityName }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="myFlight_dep-main">
                        <div class="myFlight_dep-main-airline">
                            <img src="{{ asset('storage/images/vietravel.webp') }}" alt="vietravel">
                            <p>Vietravel Airlines</p>
                        </div>
                        <div class="myFlight_dep-main-info">
                            <div>
                                <p>00:00</p>
                                <label>{{ $from }}</label>
                            </div>
                            <div>
                                <span></span>
                                <i class="fa-solid fa-plane"></i>
                                <span></span>
                            </div>
                            <div>
                                <p>99:99</p>
                                <label>{{ $to }}</label>
                            </div>
                            <div>
                                <?php
                                foreach ($flight_listNameCity as $flight) {
                                    echo '<p>'. $flight['time'] .'</p>';
                                }
                                ?>
                                <a>Bay thẳng</a>
                            </div>
                        </div>
                        <button>Đổi chuyến bay đi</button>
                    </div>
                </div>
                @if ($return_date !== '')
                    <div class="myFlight_return">
                        <div class="myFlight_return-header">
                            <label><span>2</span></label>
                            <div>
                                <p>{{ $home_controller->formatVietnameseDate($return_date) }}</p>
                                @foreach ($flight_listNameCity as $item)
                                    <p>{{ $item->arrival_cityName }} <i class="fa-solid fa-arrow-right-long"></i> {{ $item->departure_cityName }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="myFlight_return-main">
                            <div class="myFlight_return-main-airline">
                                <img src="{{ asset('storage/images/vietravel.webp') }}" alt="vietravel">
                                <p>Vietravel Airlines</p>
                            </div>
                            <div class="myFlight_return-main-info">
                                <div>
                                    <p>00:00</p>
                                    <label>{{ $to }}</label>
                                </div>
                                <div>
                                    <span></span>
                                    <i class="fa-solid fa-plane"></i>
                                    <span></span>
                                </div>
                                <div>
                                    <p>99:99</p>
                                    <label>{{ $from }}</label>
                                </div>
                                <div>
                                    @foreach ($flight_listNameCity as $flight)
                                        <p>{{ $flight->time }}</p>
                                    @endforeach
                                    <a>Bay thẳng</a>
                                </div>
                            </div>
                            <button>Đổi chuyến bay đi</button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="list_filter">
                <h3>Bộ lọc</h3>
                <label class="list_filter-from">Từ</label>
                <select name="" id="list_filter-from">
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
                <label class="list_filter-to">Đến</label>
                <select name="" id="list_filter-to">
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
                <label class="list_filter-dateGo">Ngày đi</label>
                <input type="date" name="" id="list_filter-dateGo">
                <div class="list_filter_airline">
                    <div class="list_filter-title" onclick="show_airline()">
                        <label>Hãng hàng không</label>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    @if ($FlightList->getAirline($from, $to)->isNotEmpty())
                        @foreach ($FlightList->getAirline($from, $to) as $item)
                            @if ($item === "Vietravel Airlines")
                                <div class="list_filter_airline-name">
                                    <input type="checkbox" name="vietravel" id="vietravel" class="filter-checkbox" value="vietravel">
                                    <label>Vietravel Airlines</label>
                                </div>
                            @elseif ($item === "VietJet Air")
                                <div class="list_filter_airline-name">
                                    <input type="checkbox" name="vietjet" id="vietjet" class="filter-checkbox" value="vietjet">
                                    <label>VietJet Air</label>
                                </div>
                            @elseif ($item === "Vietnam Airlines")
                                <div class="list_filter_airline-name">
                                    <input type="checkbox" name="vietnam" id="vietnam" class="filter-checkbox" value="vietnam">
                                    <label>Vietnam Airlines</label>
                                </div>
                            @elseif ($item === "Bamboo Airways")
                                <div class="list_filter_airline-name">
                                    <input type="checkbox" name="bamboo" id="bamboo" class="filter-checkbox" value="bamboo">
                                    <label>Bamboo Airways</label>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="list_filter_time">
                    <div class="list_filter-title" onclick="flight_time()">
                        <label>Thời gian bay</label>
                        <i class="list_filter-title2 fa-solid fa-angle-down"></i>
                    </div>
                    <div class="list_filter_time-full">
                        <span>Giờ cất cánh</span>
                        <div class="list_filter_time-allDeparture">
                            <div data-time="00:00 - 06:00">
                                <label>Đêm đến Sáng</label>
                                <p>00:00 - 06:00</p>
                            </div>
                            <div data-time="06:00 - 12:00">
                                <label>Sáng đến Trưa</label>
                                <p>06:00 - 12:00</p>
                            </div>
                            <div data-time="12:00 - 18:00">
                                <label>Trưa đến Tuối</label>
                                <p>12:00 - 18:00</p>
                            </div>
                            <div data-time="18:00 - 24:00">
                                <label>Tối đến Đêm</label>
                                <p>18:00 - 24:00</p>
                            </div>
                        </div>
                        <span>Giờ hạ cánh</span>
                        <div class="list_filter_time-allArrival">
                            <div data-time="00:00-06:00">
                                <label>Đêm đến Sáng</label>
                                <p>00:00 - 06:00</p>
                            </div>
                            <div data-time="06:00-12:00">
                                <label>Sáng đến Trưa</label>
                                <p>06:00 - 12:00</p>
                            </div>
                            <div data-time="12:00-18:00">
                                <label>Trưa đến Tối</label>
                                <p>12:00 - 18:00</p>
                            </div>
                            <div data-time="18:00-24:00">
                                <label>Tối đến Đêm</label>
                                <p>18:00 - 24:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($return_date === '')
        <div class="flight_lists">
            @if ($flight_lists->isNotEmpty())
                @foreach ($flight_lists as $flight)
                    @if ($flight->airline === "Vietravel Airlines")
                        <div class="flight_list vietravel" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="{{ asset('storage/images/vietravel.webp') }}" alt="vietravel">
                                    <p>{{ $flight->airline }}</p>
                                </div>
                    @elseif ($flight->airline === "VietJet Air")
                        <div class="flight_list vietjet" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="{{ asset('storage/images/vietjet.webp') }}" alt="">
                                    <p>{{ $flight->airline }}</p>
                                </div>
                    @elseif ($flight->airline === "Vietnam Airlines")
                        <div class="flight_list vietnam" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="{{ asset('storage/images/vietnam.webp') }}" alt="">
                                    <p>{{ $flight->airline }}</p>
                                </div>
                    @elseif ($flight->airline === "Bamboo Airways")
                        <div class="flight_list bamboo" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="{{ asset('storage/images/bamboo.png') }}" alt="">
                                    <p>{{ $flight->airline }}</p>
                                </div>
                    @endif
                                <div class="flight_list-info">
                                    <div class="flight_list-from">
                                        <p>{{ $flight->departure_time }}</p>
                                        <p>{{ $from }}</p>
                                    </div>
                                    <div class="flight_list-time">
                                        <p>{{ $flight->time }}</p>
                                        <div class="flight_list-timeLength">
                                            <div></div>
                                            <span></span>
                                            <div></div>
                                        </div>
                                        <p>Bay thẳng</p>
                                    </div>
                                    <div class="flight_list-to">
                                        <p>{{ $flight->arrival_time }}</p>
                                        <p>{{ $to }}</p>
                                    </div>
                                </div>
                                <div class="flight_list-price">
                                    <p>{{ $flight->price_adult }} VND<span>/khách</span></p>
                                </div>
                            </div>
                            <?php
                            if (!function_exists('strToInt')) {
                                function strToInt($str) {
                                    return str_replace('.', '', $str);
                                }
                            }
                            
                            if (!function_exists('intToStr')) {
                                function intToStr($int) {
                                    return number_format((int)$int, 0, '', '.');
                                }
                            }

                            $priceAdult = intToStr(strToInt($flight->price_adult) * $countAdult);
                            $priceChild = intToStr(strToInt($flight->price_child) * $countChild);
                            $priceInfant = intToStr(strToInt($flight->price_infant) * $countInfant);
                            $price = intToStr(strToInt($priceAdult) + strToInt($priceChild) + strToInt($priceInfant));
                            ?>
                            <div class="flight_list-infoOther">
                                <button type="button" onclick="openYourTrip('{{ $flight->airline }}', '{{ $flight->departure_time }}', '{{ $flight->arrival_time }}', '{{ $price }}', '{{ $priceAdult }}', '{{ $priceChild }}', '{{ $priceInfant }}', '{{ $flight->flight_code }}')">Chọn</button>
                            </div>
                        </div>
                @endforeach
            @else
                <div class="no-result">Không tìm thấy chuyến bay phù hợp</div>
            @endif
                <div class="no-results">Không tìm thấy chuyến bay phù hợp</div>
            </div>
        @else
            @if ($flight_lists->isNotEmpty())
            <div class="flight_lists">
                @foreach ($flight_lists as $flight)
                    @if ($flight->airline === "Vietravel Airlines")
                        <div class="flight_list vietravel" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="{{ asset('storage/images/vietravel.webp') }}" alt="vietravel">
                                    <p>{{ $flight->airline }}</p>
                                </div>
                    @elseif ($flight->airline === "VietJet Air")
                        <div class="flight_list vietjet" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="{{ asset('storage/images/vietjet.webp') }}" alt="">
                                    <p>{{ $flight->airline }}</p>
                                </div>
                    @elseif ($flight->airline === "Vietnam Airlines")
                        <div class="flight_list vietnam" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="{{ asset('storage/images/vietnam.webp') }}" alt="">
                                    <p>{{ $flight->airline }}</p>
                                </div>
                    @elseif ($flight->airline === "Bamboo Airways")
                        <div class="flight_list bamboo" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="{{ asset('storage/images/bamboo.png') }}" alt="">
                                    <p>{{ $flight->airline }}</p>
                                </div>
                    @endif
                                <div class="flight_list-info">
                                    <div class="flight_list-from">
                                        <p>{{ $flight->departure_time }}</p>
                                        <p>{{ $from }}</p>
                                    </div>
                                    <div class="flight_list-time">
                                        <p>{{ $flight->time }}</p>
                                        <div class="flight_list-timeLength">
                                            <div></div>
                                            <span></span>
                                            <div></div>
                                        </div>
                                        <p>Bay thẳng</p>
                                    </div>
                                    <div class="flight_list-to">
                                        <p>{{ $flight->arrival_time }}</p>
                                        <p>{{ $to }}</p>
                                    </div>
                                </div>
                                <div class="flight_list-price">
                                    <p>{{ $flight->price_adult }} VND<span>/khách</span></p>
                                </div>
                            </div>
                            <?php
                            if (!function_exists('strToInt')) {
                                function strToInt($str) {
                                    return str_replace('.', '', $str);
                                }
                            }
                            
                            if (!function_exists('intToStr')) {
                                function intToStr($int) {
                                    return number_format((int)$int, 0, '', '.');
                                }
                            }

                            $priceAdultdep = intToStr(strToInt($flight["price_adult"]) * $countAdult);
                            $priceChilddep = intToStr(strToInt($flight["price_child"]) * $countChild);
                            $priceInfantdep = intToStr(strToInt($flight["price_infant"]) * $countInfant);
                            $pricedep = intToStr(strToInt($priceAdultdep) + strToInt($priceChilddep) + strToInt($priceInfantdep));
                            ?>
                            <div class="flight_list-infoOther">
                                <button type="button" onclick="chooseFirstFlight('{{ $flight->airline }}', '{{ $flight->departure_time }}', '{{ $flight->arrival_time }}', '{{ $pricedep }}', '{{ $priceAdultdep }}', '{{ $priceChilddep }}', '{{ $priceInfantdep }}', '{{ $flight->flight_code }}')">Chọn</button>
                            </div>
                        </div>
                @endforeach
            </div>
            @else
            <div class="no-result dep">Không tìm thấy chuyến bay đi phù hợp</div>
            @endif

            @if ($flight_listsReturn->isNotEmpty())
                <div class="flight_lists flight_lists-return">
                    @foreach ($flight_listsReturn as $flight)
                        @if ($flight->airline === "Vietravel Airlines")
                            <div class="flight_list vietravel" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                                <div class="flight_list-main">
                                    <div class="flight_list-logo">
                                        <img src="{{ asset('storage/images/vietravel.webp') }}" alt="vietravel">
                                        <p>{{ $flight->airline }}</p>
                                    </div>
                        @elseif ($flight->airline === "VietJet Air")
                            <div class="flight_list vietjet" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                                <div class="flight_list-main">
                                    <div class="flight_list-logo">
                                        <img src="{{ asset('storage/images/vietjet.webp') }}" alt="">
                                        <p>{{ $flight->airline }}</p>
                                    </div>
                        @elseif ($flight->airline === "Vietnam Airlines")
                            <div class="flight_list vietnam" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                                <div class="flight_list-main">
                                    <div class="flight_list-logo">
                                        <img src="{{ asset('storage/images/vietnam.webp') }}" alt="">
                                        <p>{{ $flight->airline }}</p>
                                    </div>
                        @elseif ($flight->airline === "Bamboo Airways")
                            <div class="flight_list bamboo" data-departure="{{ $flight->departure_time }}" data-arrival="{{ $flight->arrival_time }}">
                                <div class="flight_list-main">
                                    <div class="flight_list-logo">
                                        <img src="{{ asset('storage/images/bamboo.png') }}" alt="">
                                        <p>{{ $flight->airline }}</p>
                                    </div>
                        @endif
                                    <div class="flight_list-info">
                                        <div class="flight_list-from">
                                            <p>{{ $flight->departure_time }}</p>
                                            <p>{{ $to }}</p>
                                        </div>
                                        <div class="flight_list-time">
                                            <p>{{ $flight->time }}</p>
                                            <div class="flight_list-timeLength">
                                                <div></div>
                                                <span></span>
                                                <div></div>
                                            </div>
                                            <p>Bay thẳng</p>
                                        </div>
                                        <div class="flight_list-to">
                                            <p>{{ $flight->arrival_time }}</p>
                                            <p>{{ $from }}</p>
                                        </div>
                                    </div>
                                    <div class="flight_list-price">
                                        <p>{{ $flight->price_adult }} VND<span>/khách</span></p>
                                    </div>
                                </div>
                                <?php
                                if (!function_exists('strToInt')) {
                                    function strToInt($str) {
                                        return str_replace('.', '', $str);
                                    }
                                }
                                
                                if (!function_exists('intToStr')) {
                                    function intToStr($int) {
                                        return number_format((int)$int, 0, '', '.');
                                    }
                                }

                                $priceAdultreturn = intToStr(strToInt($flight["price_adult"]) * $countAdult);
                                $priceChildreturn = intToStr(strToInt($flight["price_child"]) * $countChild);
                                $priceInfantreturn = intToStr(strToInt($flight["price_infant"]) * $countInfant);
                                $pricereturn = intToStr(strToInt($priceAdultreturn) + strToInt($priceChildreturn) + strToInt($priceInfantreturn));
                                $priceSum = intToStr(strToInt($pricedep) + strToInt($pricereturn));
                                ?>
                                <div class="flight_list-infoOther">
                                    <button type="button" onclick="chooseSecondFlight('{{ $flight->airline }}', '{{ $flight->departure_time }}', '{{ $flight->arrival_time }}', '{{ $priceSum }}', '{{ $priceAdultreturn }}', '{{ $priceChildreturn }}', '{{ $priceInfantreturn }}', '{{ $flight->flight_code }}')">Chọn</button>
                                </div>
                            </div>
                    @endforeach
                </div>
            @else
            <div class="no-result return">Không tìm thấy chuyến bay về phù hợp</div>
            @endif
            <div class="no-results">Không tìm thấy chuyến bay phù hợp</div>
        @endif
    </section>
    <section class="yourTrip" id="yourTrip">
        <div class="yourTrip_background"></div>
        <form method="GET" class="yourTrip_content" action="{{ route('form_info') }}">
            <div class="yourTrip_content-header">
                <div>
                    <i class="fa-solid fa-xmark yourTrip_content-header-close"></i>
                    <h3 class="yourTrip_content-title">Chuyến đi của bạn</h3>
                </div>
                <div>
                    <i class="fa-regular fa-bookmark"></i>
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
            </div>
            @if ($flight_listsReturn->isNotEmpty())
            <div class="yourTrip_content-myFlight">
                <p onclick="openMyFlight(this, 'first-child', 'flex', 'none')">Chuyến bay đi</p>
                <p onclick="openMyFlight(this, 'last-child', 'none', 'flex')">Chuyến bay về</p>
            </div>
            @endif
            <div class="yourTrip_content-body">
                <div class="yourTrip_content-info">
                    <div class="yourTrip_content-info-content">
                        <div class="yourTrip_content-info-content1">
                            @foreach ($flight_listNameCity as $flight)
                                <p>{{ $flight->departure_cityName }}</p>
                                <i class="fa-solid fa-arrow-right"></i>
                                <p>{{ $flight->arrival_cityName }}</p>
                            @endforeach
                            <?php
                            list($year, $month, $day) = explode('-', $departure);
                            ?>
                            <p>Ngày {{ $day }} Tháng {{ $month }} Năm {{ $year }}</P>
                        </div>
                        <div class="yourTrip_content-info-content2">
                            <div class="content-info-content2-logo">
                                <img src="{{ asset('storage/images/vietravel.webp') }}" alt="">
                                <p>Vietravel Airlines</p>
                            </div>
                            <div class="content-info-content2-info">
                                <div class="content2-info-from">
                                    <p>00:00</p>
                                    <p>{{ $from }}</p>
                                </div>
                                <div class="content2-info-time">
                                    @foreach ($flight_listNameCity as $item)
                                        <p>{{ $item->time }}</p>
                                    @endforeach
                                    <div class="content2-info-timeLength">
                                        <div></div>
                                        <span></span>
                                        <div></div>
                                    </div>
                                    <p>Bay thẳng</p>
                                </div>
                                <div class="content2-info-to">
                                    <p>00:00</p>
                                    <p>{{ isset($to) ? $to : '' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="yourTrip_content-info-content3">Chi tiết</div>
                    </div>
                </div>
                <div class="yourTrip_content-info yourTrip_content-info-return">
                    <div class="yourTrip_content-info-content">
                        <div class="yourTrip_content-info-content1">
                            @foreach ($flight_listNameCity as $item)
                                <p>{{ $item->departure_cityName }}</p>
                                <i class="fa-solid fa-arrow-right"></i>
                                <p>{{ $item->arrival_cityName }}</p>
                            @endforeach
                            <p>{{ $home_controller->formatVietnameseDate($return_date) }}</p>
                        </div>
                        <div class="yourTrip_content-info-content2">
                            <div class="content-info-content2-logo">
                                <img src="{{ asset('storage/images/vietravel.webp') }}" alt="">
                                <p>Vietravel Airlines</p>
                            </div>
                            <div class="content-info-content2-info">
                                <div class="content2-info-from">
                                    <p>00:00</p>
                                    <p>{{ $to }}</p>
                                </div>
                                <div class="content2-info-time">
                                    @foreach ($flight_listNameCity as $item)
                                        <p>{{ $item->time }}</p>
                                    @endforeach
                                    <div class="content2-info-timeLength">
                                        <div></div>
                                        <span></span>
                                        <div></div>
                                    </div>
                                    <p>Bay thẳng</p>
                                </div>
                                <div class="content2-info-to">
                                    <p>00:00</p>
                                    <p>{{ $from }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="yourTrip_content-info-content3">Chi tiết</div>
                    </div>
                </div>
                <div class="yourTrip_content-info-type">

                </div>
            </div>
            <div class="yourTrip_content-footer">
                <div class="yourTrip_content-footer-left">
                    <i class="fa-solid fa-angle-up"></i>
                    <div>
                        <label>Tổng cộng cho {{ $count_ticket }} khách</label>
                        <p><span>ádasd</span> VND</p>
                    </div>
                </div>
                <div class="yourTrip_content-footer-btn">
                    <button type="submit">Tiếp tục đặt chỗ</button>
                </div>
            </div>
            <div class="yourTrip_content-footer-list">
                <span></span>
                @if ($countAdult > 0)
                    <div class="footer_list-adult">
                        <label>+&nbsp<span></span><p>&nbsp(Người lớn)</p>&nbsp(x{{ $countAdult }})</label>
                        <label><p></p>VND</label>
                    </div>
                @endif
                @if ($countChild > 0)
                    <div class="footer_list-child">
                        <label>+&nbsp<span></span><p>&nbsp(Trẻ em)</p>&nbsp(x{{ $countChild }})</label>
                        <label><p></p>VND</label>
                    </div>
                @endif
                @if ($countInfant > 0)
                    <div class="footer_list-infant">
                        <label>+&nbsp<span></span><p>&nbsp(Sơ sinh)</p>&nbsp(x{{ $countInfant }})</label>
                        <label><p></p>VND</label>
                    </div>
                @endif
            </div>
            @if ($flight_listsReturn->isNotEmpty())
                <div class="yourTrip_content-footer-listReturn">
                    <span></span>
                    @if ($countAdult > 0)
                        <div class="footer_list-adultReturn">
                            <label>+&nbsp<span></span><p>&nbsp(Người lớn)</p>&nbsp(x{{ $countAdult }})</label>
                            <label><p></p>VND</label>
                        </div>
                    @endif
                    @if ($countChild > 0)
                        <div class="footer_list-childReturn">
                            <label>+&nbsp<span></span><p>&nbsp(Trẻ em)</p>&nbsp(x{{ $countChild }})</label>
                            <label><p></p>VND</label>
                        </div>
                    @endif
                    @if ($countInfant > 0)
                        <div class="footer_list-infantReturn">
                            <label>+&nbsp<span></span><p>&nbsp(Sơ sinh)</p>&nbsp(x{{ $countInfant }})</label>
                            <label><p></p>VND</label>
                        </div>
                    @endif
                </div>
            @endif

            <input type="hidden" name="count_ticket" value="{{$count_ticket}}">
            <input type="hidden" name="countChild" value="{{$countChild}}">
            <input type="hidden" name="countAdult" value="{{$countAdult}}">
            <input type="hidden" name="countInfant" value="{{$countInfant}}">
            <input type="hidden" name="fromName" value="{{$flight['departure_cityName']}}">
            <input type="hidden" name="toName" value="{{$flight['arrival_cityName']}}">
            <input type="hidden" name="from" value="{{$from}}">
            <input type="hidden" name="to" value="{{$to}}">
            <input type="hidden" name="date" value="{{$departure}}">
            <input type="hidden" name="airline" id="airline">
            <input type="hidden" name="chairType" value="{{ $chairType }}">
            <input type="hidden" name="time" value="{{$flight['time']}}">
            <input type="hidden" name="departure_time" id="departure_time">
            <input type="hidden" name="arrival_time" id="arrival_time">
            <input type="hidden" name="flight_code" id="flight_code">
            <input type="hidden" name="price" id="price">
        
            @if ($flight_listsReturn->isNotEmpty())
                <input type="hidden" name="return_date" value="{{ $return_date }}">
                <input type="hidden" name="flight_codeReturn" id="flight_codeReturn">
                <input type="hidden" name="airlineReturn" id="airlineReturn">
            @endif
        </form>
    </section>
    


    <script src="{{ asset('assets/js/flight_list.js') }}"></script>
</body>
</html>