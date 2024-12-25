<?php
use App\Models\FlightList;
use App\Http\Controllers\HomeController;

$FlightList = new FlightList();
$home_controller = new HomeController();
// $flight_listNameCity = $FlightList->getNameCity($from, $to);
// $flight_lists = $FlightList->get_flights($from, $to, $departure, $chairType);
// $flight_listsReturn = $FlightList->get_flights($to, $from, $return_date, $chairType);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flight List</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flight_list.css') }}">
</head>
<body>
    @include('elements.header')

    <div class="label_list">Danh sách chuyến bay</div>

    <section class="list">
        <div class="list_container">
            <div class="myFlight_header">
                <i class="fa-solid fa-jet-fighter"></i>
                <p>Chuyến bay của bạn</p>
            </div>
            <div class="myFlight_dep selected_flight">
                <div class="myFlight_dep-header">
                    <label><span>1</span></label>
                    <div>
                        <p>{{ $home_controller->formatVietnameseDate($customers->flight_date) }}</p>
                        <p>{{ $customers->departure_cityName }} <i class="fa-solid fa-arrow-right-long"></i> {{ $customers->arrival_cityName }}</p>
                    </div>
                </div>
            </div>
            <div class="list_filter">
                <h3>Bộ lọc</h3>
                <label class="list_filter-from">Từ</label>
                <select class="departure" id="list_filter-from">
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
                <select class="arrival" id="list_filter-to">
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
                <input type="date" class="date" id="list_filter-dateGo">
                <i class="fa-solid fa-magnifying-glass search" style="display: flex; justify-content: end; margin-top: 10px; color: #728156; cursor: pointer;"></i>
                <div class="list_filter_airline">
                    <div class="list_filter-title" onclick="show_airline()">
                        <label>Hãng hàng không</label>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
    
                    @if ($FlightList->getAirline($customers->departure_city, $customers->arrival_city)->isNotEmpty())
                        @foreach ($FlightList->getAirline($customers->departure_city, $customers->arrival_city) as $item)
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
        <input type="hidden" class="customer_type" value="{{ $customers->customer_type }}">
        <div class="flight_lists">
            @if ($flights->isNotEmpty())
                @foreach ($flights as $flight)
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
                                    <p>{{ $customers->departure_city }}</p>
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
                                    <p>{{ $customers->arrival_city }}</p>
                                </div>
                            </div>
                            <div class="flight_list-price">
                                <p>{{ $flight->price_adult }} VND<span>/khách</span></p>
                            </div>
                        </div>
                        <div class="flight_list-infoOther">
                            <button style="width: max-content; padding: 0 10px;"><a style="color: #fff" href="{{ route('changeTicketInfo', ['customer_id'=>$customers->customer_id, 'flight_id'=>$flight->id]) }}">Đổi chuyến bay</a></button>
                        </div>
                    </div>
                @endforeach
            @else
            <div class="no-result">Không tìm thấy chuyến bay phù hợp</div>
            @endif
            <div class="no-results">Không tìm thấy chuyến bay phù hợp</div>
        </div>
    </section>
    <input type="hidden" name="customer_id" value="{{ $customers->customer_id }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.search').click(function() {
                var departure = $('.departure').val();
                var arrival = $('.arrival').val();
                var date = $('.date').val();
                var customer_type = $('.customer_type').val();
                var customer_id = $('input[name="customer_id"]').val();
                
    
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/filter-flight",
                    method: 'POST',
                    data: {
                        departure: departure,
                        arrival: arrival,
                        date: date,
                        customer_type: customer_type,
                        _token: '{{ csrf_token() }}'
                    }, 
                    success: function(response) {
                        if (response.success) {
                            function formatVietnameseDate(date) {
                                const datedep = new Date(date);

                                const daydep = datedep.getDate().toString().padStart(2, '0');
                                const monthdep = (datedep.getMonth() + 1).toString().padStart(2, '0'); // Tháng trong JavaScript bắt đầu từ 0
                                const yeardep = datedep.getFullYear();

                                const daysOfWeek = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
                                const dayOfWeekdep = daysOfWeek[datedep.getDay()]; // Lấy thứ trong tuần (0 - Chủ Nhật, 6 - Thứ Bảy)

                                return `${dayOfWeekdep}, ${daydep} thg ${monthdep} ${yeardep}`;
                            }
                            var flights = response.flights;
                            if (flights.length > 0) {
                                
                                $('.myFlight_dep').empty();
                                $('.list_filter_airline').empty();
                                $('.flight_lists').empty();
                                $('.myFlight_dep').append(`
                                <div class="myFlight_dep-header">
                                    <label><span>1</span></label>
                                    <div>
                                        <p>${ flights[0].flight_date }</p>
                                        <p>${ flights[0].departure_cityName } <i class="fa-solid fa-arrow-right-long"></i> ${ flights[0].arrival_cityName }</p>
                                    </div>
                                </div>
                                `);
                                
                                $('.list_filter_airline').append(`
                                <div class="list_filter-title" onclick="show_airline()">
                                    <label>Hãng hàng không</label>
                                    <i class="fa-solid fa-angle-down"></i>
                                </div>
                                `);
                                flights.forEach(flight => {
                                    let airlineClass = '';
                                    let airlineImage = '';
                                    let airlineCheckbox = '';

                                    if (flight.airline === "Vietravel Airlines") {
                                        airlineClass = 'vietravel';
                                        airlineImage = '/storage/images/vietravel.webp';
                                        airlineCheckbox = `<input type="checkbox" name="vietravel" id="vietravel" class="filter-checkbox" value="vietravel">
                                                        <label>Vietravel Airlines</label>`;
                                    } else if (flight.airline === "VietJet Air") {
                                        airlineClass = 'vietjet';
                                        airlineImage = '/storage/images/vietjet.webp';
                                        airlineCheckbox = `<input type="checkbox" name="vietjet" id="vietjet" class="filter-checkbox" value="vietjet">
                                                        <label>VietJet Air</label>`;
                                    } else if (flight.airline === "Vietnam Airlines") {
                                        airlineClass = 'vietnam';
                                        airlineImage = '/storage/images/vietnam.webp';
                                        airlineCheckbox = `<input type="checkbox" name="vietnam" id="vietnam" class="filter-checkbox" value="vietnam">
                                                        <label>Vietnam Airlines</label>`;
                                    } else if (flight.airline === "Bamboo Airways") {
                                        airlineClass = 'bamboo';
                                        airlineImage = '/storage/images/bamboo.png';
                                        airlineCheckbox = `<input type="checkbox" name="bamboo" id="bamboo" class="filter-checkbox" value="bamboo">
                                                        <label>Bamboo Airways</label>`;
                                    }

                                    $('.list_filter_airline').append(`
                                        <div class="list_filter_airline-name">
                                            ${airlineCheckbox}
                                        </div>
                                    `);

                                    $('.flight_lists').append(`
                                        <div class="flight_list ${airlineClass}" data-departure="${flight.departure_time}" data-arrival="${flight.arrival_time}">
                                            <div class="flight_list-main">
                                                <div class="flight_list-logo">
                                                    <img src="${airlineImage}" alt="${flight.airline}">
                                                    <p>${flight.airline}</p>
                                                </div>
                                                <div class="flight_list-info">
                                                    <div class="flight_list-from">
                                                        <p>${flight.departure_time}</p>
                                                        <p>${flight.departure_city}</p>
                                                    </div>
                                                    <div class="flight_list-time">
                                                        <p>${flight.time}</p>
                                                        <div class="flight_list-timeLength">
                                                            <div></div>
                                                            <span></span>
                                                            <div></div>
                                                        </div>
                                                        <p>Bay thẳng</p>
                                                    </div>
                                                    <div class="flight_list-to">
                                                        <p>${flight.arrival_time}</p>
                                                        <p>${flight.arrival_city}</p>
                                                    </div>
                                                </div>
                                                <div class="flight_list-price">
                                                    <p>${flight.price_adult} VND<span>/khách</span></p>
                                                </div>
                                            </div>
                                            <div class="flight_list-infoOther">
                                                <div class="flight_list-infoOther">
                                                    <button style="width: max-content; padding: 0 10px;"><a style="color: #fff" href="/change-ticket-info/${customer_id}/${flight.id}">Đổi chuyến bay</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    `);
                                });
                            } else {
                                $('.flight_lists').append(`<div class="no-result">Không tìm thấy chuyến bay phù hợp</div>`)
                            }
                        }
                    }
                })
            });
        });
        function show_airline() {
            var a = document.querySelectorAll('.list_filter_airline-name')
            var c = document.querySelector('.list_filter-title i')

            a.forEach(function (b) {
                if (b.style.display === 'flex') {
                    b.style.display = 'none'
                    c.classList.remove('fa-angle-up')
                    c.classList.add('fa-angle-down')
                } else {
                    b.style.display = 'flex'
                    c.classList.add('fa-angle-up')
                    c.classList.remove('fa-angle-down')
                }
            })
        }

        function flight_time() {
            var a = document.querySelector('.list_filter_time-full')
            var b = document.querySelector('.list_filter-title2')

            if (a.style.display === 'flex') {
                a.style.display = 'none'
                b.classList.remove('fa-angle-up')
                b.classList.add('fa-angle-down')
            } else {
                a.style.display = 'flex'
                b.classList.add('fa-angle-up')
                b.classList.remove('fa-angle-down')
            }
        }

        function confirmChange(id) {
            if (confirm('Xác nhận đổi chuyến bay?')) {
                fetch(`/delete-flight/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Có lỗi xảy ra. Vui lòng thử lại!');
                });
            }
        }

        document.querySelectorAll('.filter-checkbox, .list_filter_time-allDeparture div, .list_filter_time-allArrival div').forEach(element => {
            element.addEventListener('click', function () {
                if (this.hasAttribute('data-time')) {
                    if (this.classList.contains('selected-time')) {
                        this.classList.remove('selected-time')
                    } else {
                        this.classList.add('selected-time')
                    }
                }

                var flights = document.querySelectorAll('.flight_list')
                var noResult = document.querySelector('.no-results')

                var hasResults = false
                
                var checkboxes = document.querySelectorAll('.filter-checkbox:checked')

                var selectedTimesDep = []
                var selectedArrival = []

                document.querySelectorAll('.list_filter_time-allDeparture div.selected-time').forEach(div => {
                    selectedTimesDep.push(div.getAttribute('data-time'))
                })
                document.querySelectorAll('.list_filter_time-allArrival div.selected-time').forEach(div => {
                    selectedArrival.push(div.getAttribute('data-time'))
                })
                
                if (checkboxes.length === 0 && selectedTimesDep.length === 0 && selectedArrival.length === 0) {
                    flights.forEach(flight => {
                        flight.style.display = 'block'
                    })
                    noResult.style.display = 'none'
                } else {
                    flights.forEach(flight => {
                        flight.style.display = 'none'
                    })

                    if (checkboxes.length === 0 && selectedTimesDep.length > 0) {
                        flights.forEach(flight => {
                            var departureTime = flight.getAttribute('data-departure')
                            var matchTime = selectedTimesDep.some(time =>timeFilter(departureTime, time))
                            if (matchTime) {
                                flight.style.display = 'block'
                                hasResults = true
                            }
                        })
                    } else if (checkboxes.length === 0 && selectedArrival.length > 0) {
                        flights.forEach(flight => {
                            var arrivalTime = flight.getAttribute('data-arrival')
                            var matchTime = selectedArrival.some(time => timeFilter(arrivalTime, time))
                            if (matchTime) {
                                flight.style.display = 'block'
                                hasResults = true
                            }
                        })
                    }

                    checkboxes.forEach(checkbox => {
                        var airline = checkbox.value;
                        
                        document.querySelectorAll('.' + airline).forEach(flight => {
                            var departureTime = flight.getAttribute('data-departure');
                            var arrivalTime = flight.getAttribute('data-arrival');

                            var matchDepTime = selectedTimesDep.length === 0 || selectedTimesDep.some(time => timeFilter(departureTime, time));
                            var matchArrTime = selectedArrival.length === 0 || selectedArrival.some(time => timeFilter(arrivalTime, time));

                            if (matchDepTime && matchArrTime) {
                                flight.style.display = 'block';
                                hasResults = true;
                            }
                        });
                    });

                    noResult.style.display = hasResults ? 'none' : 'block'
                }
            })
        })
    </script>
</body>
</html>