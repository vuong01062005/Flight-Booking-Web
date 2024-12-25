@php
    use App\Models\FlightChairList;
    use App\Models\AccountUser;
    
    $FlightChairList = new FlightChairList();
    $AccountUser = new AccountUser();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Infomation</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/form_info.css') }}">
</head>
<body>
    <header class="header">
        <a href="{{ route('home') }}" class="header_logo">Travel VH</a>
        <nav class="header_step">
            <i class="fa-solid fa-sack-dollar"></i>
            @php
                $wallet = $AccountUser->getWalletbyID(session('userID'));
            @endphp
            <p>{{ $wallet->wallet }} VND</p>
            <input type="hidden" name="ID_account" value="{{ session('userID') }}">
            <input type="hidden" name="wallet" value="{{ $wallet->wallet }}">
        </nav>
    </header>
    <div style="display: flex; background-color: rgb(247 249 250);" id="form_info">
        @csrf
        <div>
            <section class="title">
                <h2>Đặt chỗ của tôi</h2>
                <p>Điền thông tin và xem lại đặt chỗ</p>
            </section>
            <section class="contact_info">
                <h2 class="contact_info-title">Thông tin liên hệ</h2>
                <div class="contact_info-content1" style="display: block">
                    <div class="contact_info-content1-header">
                        <h4>{{ $contact->first_name }} {{ $contact->last_name }}</h4>
                        <p></p>
                    </div>
                    <div class="contact_info-content1-main">
                        <div class="contact_info-content1-phone">
                            <p>Số di động</p>
                            <label>{{ $contact->phone }}</label>
                        </div>
                        <div class="contact_info-content1-email">
                            <p>Email</p>
                            <label>{{ $contact->email }}</label>
                        </div>
                    </div>
                </div>
            </section>
            <section class="customer_info">
                <h2>Thông tin khách hàng</h2>
                <input type="hidden" name="customer_id" value="{{ $customers->customer_id }}">
                <div class="customer_info-content" style="display: none">
                    <div class="customer_info-content-header">
                        <h4>Thông tin</h4>
                        <p onclick="saveCustomer()">Lưu</p>
                    </div>
                    <div class="customer_info-content-main">
                        <div class="customer_info-content1">
                            <p>Danh xưng<span>*</span></p>
                            <select class="customer_info-content1Input">
                                <option value="Ông" <?= $customers->title === "Ông" ? "selected" : "" ?>>Ông</option>
                                <option value="Bà" <?= $customers->title === "Bà" ? "selected" : "" ?>>Bà</option>
                                <option value="Cô" <?= $customers->title === "Cô" ? "selected" : "" ?>>Cô</option>
                            </select>
                        </div>
                        <div class="customer_info-content-main2">
                            <div>
                                <p>Họ (vd:Nguyen)<span>*</span></p>
                                <input type="text" name="" class="customer_info-content-main2-Fname" value="{{ $customers->first_name }}">
                                <p>như trên CCCD (không dấu)</p>
                            </div>
                            <div>
                                <p>Tên Đệm và Tên (vd: Van A)<span>*</span></p>
                                <input type="text" name="" class="customer_info-content-main2-Lname" value="{{ $customers->last_name }}">
                                <p>như trên CCCD (không dấu)</p>
                            </div>
                            <div class="customer_info-content-main2Date">
                                <p>Ngày sinh<span>*</span></p>
                                <div>
                                    @php
                                        list($year, $month, $day) = explode('-', $customers->birthday);
                                    @endphp
                                    <select name="" class="day">
                                        @for ($j = 1; $j < 32; $j++)
                                        <option value="{{ $j }}" {{ $day == $j ? 'selected' : '' }}>{{ $j }}</option>
                                        @endfor
                                    </select>
                                    <select name="" class="month">
                                        <option value=""></option>
                                        @for ($k = 1; $k < 13; $k++)
                                            <option value="{{ $k }}" {{ $month == $k ? 'selected' : '' }}>{{ $k }}</option>
                                        @endfor
                                    </select>
                                    <select name="" class="year">
                                        <option value=""></option>
                                        @for ($h = 1924; $h < 2013; $h++)
                                            <option value="{{ $h }}" {{ $year == $h ? 'selected' : '' }}>{{ $h }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <p>Hành khách người lớn (trên 12 tuổi)</p>
                            </div>
                            <div class="customer_info-content-main2nation">
                                <p>Quốc tịch<span>*</span></p>
                                <select name="" class="nation">
                                    <option value="Viet Nam">Viet Nam</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="customer_info-content2" style="display: block">
                    <div class="customer_info-content2-header">
                        <h4>{{ $customers->title }} {{ $customers->first_name }} {{ $customers->last_name }}</h4>
                        <p onclick="openItem('.customer_info-content', '.customer_info-content2')">Chỉnh sửa thông tin</p>
                    </div>
                    <div class="customer_info-content2-main">
                        <div class="customer_info-content2-main1">
                            <p>Ngày sinh</p>
                            <label>{{ $customers->birthday }}</label>
                        </div>
                        <div class="customer_info-content2-main2 ">
                            <p>Quốc tịch</p>
                            <label>{{ $customers->nationality }}</label>
                        </div>
                    </div>
                </div>
            </section>

            <section class="choose_chair" style="display: block">
                <div class="choose_chair-main">
                    <h2>Chọn ghế</h2>
                    <div class="choose_chair-content-header">
                        <div>
                            <i class="fa-solid fa-wheelchair"></i>
                            <h4>Số ghế</h4>
                        </div>
                        <p onclick="openselectedChair()">Chọn lại ghế</p>
                    </div>
                    <div class="choose_chair-content-main">
                        <p>Cửa sổ hay lối đi? Chọn chỗ ngồi tốt nhất giúp bạn thoải mái suốt chuyến đi.</p>
                    </div>
                </div>
                <div class="choose_chair-main btn">
                    <button>Xác nhận đổi vé</button>
                </div>
            </section>
        </div>
        <section class="choose_chairDetail">
            <div class="choose_chairDetail-content">
                <div class="choose_chairDetail-content-header">
                    <div>
                        <i class="fa-solid fa-wheelchair"></i>
                        <h3>Số ghế</h3>
                    </div>
                    <i onclick="closeSelectedChair()" class="fa-solid fa-xmark"></i>
                </div>
                <div class="choose_chairDetail-content-info">
                    <div class="chairDetail-content-infoAddress">
                        <p>Chuyến bay 1 trong 1</p>
                        <p>{{ $flight->departure_city }} ({{ $flight->departure_cityName }})</p>
                        <i class="fa-solid fa-arrow-right-long"></i>
                        <p>{{ $flight->arrival_city }} ({{ $flight->arrival_cityName }})</p>
                    </div>
                    <div class="chairDetail-content-infoAirline">
                        <p>{{ $flight->airline }}</p>
                        <label></label>
                        <p>{{ $customers->chairType }}</p>
                        <label></label>
                        <p>{{ $flight->time }}</p>
                    </div>
                </div>
                <div class="choose_chairDetail-content-main">
                    <div class="chairDetail_content-main-left">
                        <div class="chairDetail_content-main-leftAdult0 selected_chair">
                            <article><p>1</p>. <span>{{ $customers->title }} {{ $customers->first_name }} {{ $customers->last_name }}</span></article>
                            <label>{{ $customers->chair_number }}</label>
                            <input type="hidden" name="chair_number" value="{{ $customers->chair_number }}">
                        </div>
                    </div>
                    <div class="chairDetail_content-main-right">
                        <div class="chairDetail_content-main-right-note">
                            <div class="chairDetail_content-main-right-noteItem">
                                <div class="squareX">X</div>
                                <p>Đã đặt</p>
                            </div>
                            <div class="chairDetail_content-main-right-noteItem">
                                <div class="square"></div>
                                <p>Chưa đặt</p>
                            </div>
                            <div class="chairDetail_content-main-right-noteItem">
                                <div class="squareV"></div>
                                <p>Đang chờ thanh toán</p>
                            </div>
                        </div>
                        @if ($customers->customer_type === 'Business Class')
                            <table class="chairDetail_content-main-right-chairDep">
                                <thead>
                                    <tr>
                                        <td>A</td>
                                        <td>B</td>
                                        <td></td>
                                        <td>C</td>
                                        <td>D</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php
                                            $count = 0;
                                            $stt = 1;
                                            $temp = 1;
                                            $chair_numbers = $FlightChairList->get_chairType($flight->flight_code, $customers->customer_type);
                                        @endphp
                                        @foreach ($chair_numbers as $chair_number)
                                            @php
                                                $count++;
                                            @endphp
                                            @if ($chair_number->status === 'Đã đặt')
                                                @if ($chair_number->chair_number == $customers->chair_number)
                                                <td><span class="square selected_chairNumber1 {{$chair_number->chair_number}}" onclick="chooseChair('{{$chair_number->chair_number}}')">1</span></td>
                                                @else
                                                <td><span class="squareX">X</span></td>
                                                @endif
                                            @elseif ($chair_number->status === 'Chưa đặt')
                                                <td><span class="square {{$chair_number->chair_number}}" onclick="chooseChair('{{$chair_number->chair_number}}')"></span></td>
                                            @elseif ($chair_number->status === 'Chờ thanh toán')
                                                <td><span class="squareV"></span></td>
                                            @endif

                                            @if ($temp == 2)
                                                <td>{{ $stt }}</td>
                                                @php
                                                    $stt ++;
                                                @endphp
                                            @endif
                                            @php
                                                $temp ++;
                                            @endphp

                                            @if ($count % 4 == 0)
                                                </tr><tr>
                                                @php
                                                    $temp = 1;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        @else
                        <table class="chairDetail_content-main-right-chairDep">
                            <thead>
                                <tr>
                                    <td>A</td>
                                    <td>B</td>
                                    <td>C</td>
                                    <td></td>
                                    <td>D</td>
                                    <td>E</td>
                                    <td>F</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                        $count = 0;
                                        $stt = 1;
                                        $temp = 1;
                                        $chair_numbers = $FlightChairList->get_chairType($flight->flight_code, $customers->customer_type);
                                    @endphp
                                    @foreach ($chair_numbers as $chair_number)
                                        @php
                                            $count++;
                                        @endphp
                                        @if ($chair_number->status === 'Đã đặt')
                                            @if ($chair_number->chair_number == $customers->chair_number)
                                            <td><span class="square selected_chairNumber1 {{$chair_number->chair_number}}" onclick="chooseChair('{{$chair_number->chair_number}}')">1</span></td>
                                            @else
                                            <td><span class="squareX">X</span></td>
                                            @endif
                                        @elseif ($chair_number->status === 'Chưa đặt')
                                            <td><span class="square {{$chair_number->chair_number}}" onclick="chooseChair('{{$chair_number->chair_number}}')"></span></td>
                                        @elseif ($chair_number->status === 'Chờ thanh toán')
                                            <td><span class="squareV"></span></td>
                                        @endif

                                        @if ($temp == 3)
                                            <td>{{ $stt }}</td>
                                            @php
                                                $stt ++;
                                            @endphp
                                        @endif
                                        @php
                                            $temp ++;
                                        @endphp

                                        @if ($count % 6 == 0)
                                            </tr><tr>
                                            @php
                                                $temp = 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
                <div class="choose_chairDetail-content-footer">
                    <div class="chairDetail-content-footer-price">
                        <div>
                            <h2>Tổng</h2>
                            @php
                                $priceOld = 0;
                                $priceOld = $FlightChairList->getPrice('price_adult', $customers->flight_code, $customers->customer_type, $customers->chair_number);
                            @endphp
                            <h2>{{ $priceOld->price_adult }}&nbsp;VND</h2>
                        </div>
                        <p>(Tất cả chuyến bay và hành khách)</p>
                    </div>
                    <button onclick="closeSelectedChair()">Xong</button>
                </div>
            </div>
        </section>
        <input type="hidden" name="flight_code" value="{{ $flight->flight_code }}">
        <section class="flight_info">
            <div class="flight_info-header">
                <i class="fa-solid fa-plane-departure"></i>
                <p>{{ $flight->departure_city }}</p>
                <i class="fa-solid fa-arrow-right" style="margin: 0 8px;"></i>
                <p>{{ $flight->arrival_city }}</p>
            </div>
            <div class="flight_info-content">
                @php
                    list($year, $month, $day) = explode('-', $flight->flight_date);
                @endphp
                <p>Chuyến bay đi <span>Ngày {{ $day }} Tháng {{ $month}} Năm {{ $year }}</span></p>
                <div class="flight_info-content-airline">
                    @if ($flight->airline == 'Vietravel Airlines')
                        <img src="{{ asset('storage/images/vietravel.webp') }}" alt="">
                        <div>
                            <p>Vietravel Airlines</p>
                            <p>{{ $customers->customer_type }}</p>
                        </div>
                    @elseif ($flight->airline == 'VietJet Air')
                        <img src="{{ asset('storage/images/vietjet.webp') }}" alt="">
                        <div>
                            <p>VietJet Air</p>
                            <p>{{ $customers->customer_type }}</p>
                        </div>
                    @elseif ($flight->airline == 'Vietnam Airlines')
                        <img src="{{ asset('storage/images/vietnam.webp') }}" alt="">
                        <div>
                            <p>Vietnam Airlines</p>
                            <p>{{ $customers->customer_type }}</p>
                        </div>
                    @elseif ($flight->airline == 'Bamboo Airways')
                        <img src="{{ asset('storage/images/bamboo.png') }}" alt="">
                        <div>
                            <p>Bamboo Airways</p>
                            <p>{{ $customers->customer_type }}</p>
                        </div>
                    @endif
                </div>
                <div class="content-info-content2-info">
                    <div class="content2-info-from">
                        <p>{{ $flight->departure_time }}</p>
                        <p>{{ $flight->departure_city }}</p>
                    </div>
                    <div class="content2-info-time">
                        <p>{{ $flight->time }}</p>
                        <div class="content2-info-timeLength">
                            <div></div>
                            <span></span>
                            <div></div>
                        </div>
                        <p>Bay thẳng</p>
                    </div>
                    <div class="content2-info-to">
                        <p>{{ $flight->arrival_time }}</p>
                        <p>{{ $flight->arrival_city }}</p>
                    </div>
                </div>
                @php
                    $priceOld = 0;
                    $priceNew = 0;
                    $price = 1;
                    if ($customers->age_category == 'Người lớn') {
                        $priceOld = $FlightChairList->getPrice('price_adult', $customers->flight_code, $customers->customer_type, $customers->chair_number);
                        $priceNew = $FlightChairList->getPricenotChairNumber('price_adult', $flight->flight_code, $customers->customer_type);
                        
                        $priceOld = (int) str_replace('.', '', $priceOld->price_adult);
                        $priceNew = (int) str_replace('.', '', $priceNew->price_adult);
                        $price = number_format($priceNew - $priceOld, 0, '', '.');
                    } elseif ($customers->age_category == 'Trẻ em') {
                        $priceOld = $FlightChairList->getPrice('price_child', $customers->flight_code, $customers->customer_type, $customers->chair_number);
                        $priceNew = $FlightChairList->getPricenotChairNumber('price_child', $flight->flight_code, $customers->customer_type);

                        $priceOld = (int) str_replace('.', '', $priceOld->price_child);
                        $priceNew = (int) str_replace('.', '', $priceNew->price_child);
                        $price = number_format($priceNew - $priceOld, 0, '', '.');
                    } elseif ($customers->age_category == 'Sơ sinh') {
                        $priceOld = $FlightChairList->getPrice('price_infant', $customers->flight_code, $customers->customer_type, $customers->chair_number);
                        $priceNew = $FlightChairList->getPricenotChairNumber('price_infant', $flight->flight_code, $customers->customer_type);

                        $priceOld = (int) str_replace('.', '', $priceOld->price_infant);
                        $priceNew = (int) str_replace('.', '', $priceNew->price_infant);
                        $price = number_format($priceNew - $priceOld, 0, '', '.');
                    }
                @endphp
            <div class="content-info-content2-price">Số tiền cần thanh toán:&nbsp;<p>{{ $price }}&nbsp;VND</p></div>
            </div>
        </section>
        <input type="hidden" name="flight_codeOld" value="{{ $customers->flight_code }}">
        <input type="hidden" name="ticket_type" value="{{ $customers->customer_type }}">
        <input type="hidden" name="chair_numberOld" value="{{ $customers->chair_number }}">
        <input type="hidden" name="price" value="{{ $price }}">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.choose_chair-main.btn button').click(function() {
                var customer_id = $('input[name="customer_id"]').val();
                var titleName = $('.customer_info-content1Input').val()
                var firstName = $('.customer_info-content-main2-Fname').val()
                var lastName = $('.customer_info-content-main2-Lname').val()
                var day = $('.day').val()
                var month = $('.month').val()
                var year = $('.year').val()
                var nation = $('.nation').val()
                var date = year + '-' + month + '-' + day
                var flight_code = $('input[name="flight_code"]').val();
                var chair_number = $('input[name="chair_number"]').val();
                var flight_codeOld = $('input[name="flight_codeOld"]').val();
                var ticket_type = $('input[name="ticket_type"]').val();
                var chair_numberOld = $('input[name="chair_numberOld"]').val();
                var price = $('input[name="price"]').val();
                var wallet = $('input[name="wallet"]').val();
                var ID_account = $('input[name="ID_account"]').val();

                $.ajax({
                    url: "/confirm-change",
                    type: "POST",
                    data: {
                        customer_id: customer_id,
                        titleName: titleName,
                        firstName: firstName,
                        lastName: lastName,
                        nation: nation,
                        date: date,
                        flight_code: flight_code,
                        chair_number: chair_number,
                        flight_codeOld: flight_codeOld,
                        ticket_type: ticket_type,
                        chair_numberOld: chair_numberOld,
                        price: price,
                        wallet: wallet,
                        ID_account: ID_account,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = "{{ route('home') }}";
                        }
                    }
                })
            })
        })
        function saveCustomer() {
            document.querySelector('.customer_info-content2').style.display = 'block'
            document.querySelector('.customer_info-content').style.display = 'none'

            document.querySelector('.customer_info-content2-header' + ' h4').innerHTML = document.querySelector('.customer_info-content1Input').value + ' ' + document.querySelector('.customer_info-content-main2-Fname').value + ' ' + document.querySelector('.customer_info-content-main2-Lname').value
            document.querySelector('.customer_info-content2-main1' + ' label').innerHTML = document.querySelector('.day').value + '-' + document.querySelector('.month').value + '-' + document.querySelector('.year').value
            document.querySelector('.customer_info-content2-main2' + ' label').innerHTML = document.querySelector('.nation').value

            // document.querySelector('.chairDetail_content-main-left' + ' article span').innerHTML = document.querySelector('.title_').value + ' ' + document.querySelector('.firstName_').value + ' ' + document.querySelector('.lastName_').value

            // if (document.querySelector('.chairDetail_content-main-left' + 'Return article span')) {
            //     document.querySelector('.chairDetail_content-main-left' + 'Return article span').innerHTML = document.querySelector('.title_').value + ' ' + document.querySelector('.firstName_').value + ' ' + document.querySelector('.lastName_').value
            // }
        }

        function openItem(a, b) {
            document.querySelector(a).style.display = 'block'
            document.querySelector(b).style.display = 'none'
        }

        function openselectedChair() {
            document.querySelector('.choose_chairDetail').style.display = 'block'
            document.body.style.overflow = 'hidden'
            window.scrollTo(0, 0)
        }
        function closeSelectedChair() {
            document.querySelector('.choose_chairDetail').style.display = 'none'
            document.body.style.overflow = 'visible'
        }

        function chooseChair(a) {
            document.querySelector('.selected_chair label').innerHTML = a;
            document.querySelector('input[name="chair_number"]').value = a
            document.querySelector('.selected_chair input').value = a

            var newChairContent = document.querySelector('.selected_chair article p').innerHTML;

            var previouslySelected = document.querySelector('.square.selected_chairNumber' + newChairContent);
            if (previouslySelected) {
                previouslySelected.classList.remove('selected_chairNumber' + newChairContent);
                previouslySelected.innerHTML = '';
            }

            var newChairElement = document.querySelector('.' + a);
            newChairElement.classList.add('selected_chairNumber' + newChairContent);
            newChairElement.innerHTML = newChairContent; 
        }
    </script>
</body>
</html>