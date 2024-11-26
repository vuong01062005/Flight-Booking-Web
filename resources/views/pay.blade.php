@php
    use App\Models\FlightChairList;
    
    $FlightChairList = new FlightChairList();
    
    for ($i=0; $i < $countAdult; $i++) {
        $FlightChairList->reservations('Chờ thanh toán', $flight_code, $chairType, $chair_Adult[$i]);
        $FlightChairList->reservations('Chờ thanh toán', $flight_codeReturn, $chairType, $chair_AdultReturn[$i]);
    }

    for ($i=0; $i < $countChild; $i++) {
        $FlightChairList->reservations('Chờ thanh toán', $flight_code, $chairType, $chair_Child[$i]);
        $FlightChairList->reservations('Chờ thanh toán', $flight_codeReturn, $chairType, $chair_ChildReturn[$i]);
    }

    for ($i=0; $i < $countInfant; $i++) {
        $FlightChairList->reservations('Chờ thanh toán', $flight_code, $chairType, $chair_Infant[$i]);
        $FlightChairList->reservations('Chờ thanh toán', $flight_codeReturn, $chairType, $chair_InfantReturn[$i]);
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pay</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pay.css') }}">
</head>
<body>
    <header class="header">
        <a href="{{ route('home') }}" class="header_logo">DINHVUONG</a>
        <nav class="header_step">
            <label>1</label>
            <p>Điền thông tin</p>
            <span></span>
            <label>2</label>
            <p>Đặt chỗ</p>
            <span></span>
            <label>3</label>
            <p>Thanh toán</p>
            <span></span>
            <label>4</label>
            <p>Vé điện tử</p>
        </nav>
    </header>
    <section class="container_main">
        <div class="container_main-cancel" onclick="openItem('pay_detail', 'container_main')">
            <i class="fa-solid fa-arrow-left"></i>
            <p>Hủy</p>
        </div>
        <div class="container_main-header">
            Hoàn tất thanh toán của bạn trước&nbsp;
            <p id="countdown">10:00</p>&nbsp;
            <i class="fa-solid fa-clock"></i>
        </div>
        <div class="container_main-pays">
            <h2>Bạn muốn thanh toán như thế nào?</h2>
            <div class="container_main-pays-qrcode">
                <div>
                    <input type="radio" name="pay" value="qrcode" checked>
                    <label>QR Code</label>
                </div>
                <div>
                    <ul>
                        <li>Đảm bảo bạn có ví điện tử hoặc ứng dụng ngân hàng di động hỗ trợ thanh toán bằng QR Code</li>
                        <li>Mã QR xuất hiện sau khi bạn nhấp vào nút 'Thanh toán'. Chỉ cần lưu hoặc chụp màn hình mã QR để hoàn tất thanh toán của bạn trong thời gian banking của bạn.</li>
                        <li>Vui long sử dụng mã QR mới nhất được cung cấp để hoàn tất thanh toán của bạn.</li>
                    </ul>
                </div>
            </div>
            <div class="container_main-pays-e-wallets">
                <div>
                    <div>
                        <input type="radio" name="pay" value="wallets">
                        <label>Ví điện tử khác</label>
                    </div>
                    <div>
                        <img src="{{ asset('storage/images/pay_1.webp') }}" alt="">
                        <img src="{{ asset('storage/images/pay_2.webp') }}" alt="">
                        <img src="{{ asset('storage/images/pay_3.webp') }}" alt="">
                    </div>
                </div>
                <div class="pays_e-wallets-content">
                    <ul>
                        <li>Thanh toán chỉ có sẵn trên ứng dụng được liệt kê bên dưới. Đảm bảo bạn đã cài đặt ứng dụng ví điện tử của mình trước khi tiếp tục.</li>
                        <li>Sau khi hấp vào nút 'Thanh Toán', bạn sẽ chuyển hướng đến chọn ví điện tử của mình để xem mã QR</li>
                        <li>Các tùy chọn có sẵn: ShoppeePay, ZaloPay, SmartPay và mPay</li>
                    </ul>
                </div>
            </div>
            <div class="container_main-pays-transfer">
                <div>
                    <input type="radio" name="pay" value="transfer">
                    <label>Chuyển khoản ngân hàng</label>
                </div>
                <div class="container_main-pays-transfer-content">
                    <ul>
                        <li>Chuyển khoản ngân hàng chỉ áp dụng từ 8 giờ sáng đến 8 giờ tối. Bạn có thể chuyển khoản từ kênh ngân hàng điện tử của MB Bank và các ngân hàng khác.</li>
                        <li>Chuyển khoản liên ngân hàng qua ATM và Internet Banking không khả dụng </li>
                        <li><strong>Hãy lựu chọn Dịch vụ Chuyển tiền Nhanh 24/7</strong> để chuyển tiền từ các ngân hàng khác ngoài MB Bank</li>
                    </ul>
                    <div>
                        <p>Chọn tài khoản đích</p>
                        <div class="pays_transfer-content pays_transfer-slected">
                            <div>
                                <input type="radio" name="pay-transfer" value="pay-transfer-mbbank" checked>
                                <label>MB Bank</label>
                            </div>
                            <img src="{{ asset('storage/images/MBBank.png') }}" alt="MBBank">
                        </div>
                        <div class="pays_transfer-content">
                            <div>
                                <input type="radio" name="pay-transfer" value="pay-transfer-vietcom">
                                <label>Vietcombank</label>
                            </div>
                            <img src="{{ asset('storage/images/vietcombank.png') }}" alt="VietCom">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container_main-btnPay">
            <div class="container_main-btnPay-price">
                <p>Tổng giá tiền</p>
                <div>
                    <p>{{ $price }} VND</p>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
            <button type="button" onclick="loading()">Thanh toán <span>QR Code</span></button>
        </div>
    </section>

    <section class="loading">
        <svg viewBox="25 25 50 50">
            <circle r="20" cy="50" cx="50"></circle>
        </svg>
        <p>Đang được xử lý, vui lòng đợi !!!</p>
    </section>

    <form method="POST" class="pay_detail" enctype="multipart/form-data">
        @csrf
        <div class="pay_detail-cancel" onclick="openItem('pay_detail', 'container_main')">
            <i class="fa-solid fa-arrow-left"></i>
            <p>Hủy</p>
        </div>
        <div class="pay_detail-content">
            <div class="pay_detail-contentLeft">
                <div class="pay_detail-contentLeft-header">
                    <label>Hoàn tất thanh toán của bạn trước&nbsp;</label>
                    <p id="countdown">00:05</p>&nbsp;
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="pay_detail-contentLeft-main">
                    <h2>Quét mã QR để thanh toán</h2>
                    <div>
                        <img src="{{ asset('storage/images/QR_code.svg') }}" alt="qrcode">
                        <p>Ngân hàng: VietQR</p>
                        <p>Số tài khoản: 000000000000</p>
                        <p>Tên tài khoản: Dinh Vuong</p>
                    </div>
                </div>
                <div class="pay_detail-button">
                    <div>
                        <label>Ảnh chuyển khoản <span>*</span></label>
                        <input type="file" accept="image/*" id="image" name="image_transfer">
                    </div>
                    <button type="submit">Thanh toán hoàn tất</button>
                </div>
            </div>
            <div class="pay_detail-contentRight">
                <div>
                    <h4>Chi tiết</h4>
                    <p>Mã đặt chỗ: <span></span></p>
                </div>
                <div>
                    <p>Số tiền</p>
                    <p>9.999.999 VND</p>
                </div>
            </div>
        </div>

        <input type="hidden" name="userID" value="{{ session('userID')}}">
        <input type="hidden" name="contact_firstName" value="{{ $contact_firstName }}">
        <input type="hidden" name="contact_lastName" value="{{ $contact_lastName }}">
        <input type="hidden" name="contact_phone" value="{{ $contact_phone }}">
        <input type="hidden" name="contact_email" value="{{ $contact_email }}">

        <input type="hidden" name="flight_code" value="{{ $flight_code }}">
        <input type="hidden" name="flight_codeReturn" value="{{ $flight_codeReturn }}">
        <input type="hidden" name="customer_type" value="{{ $chairType }}">

        <input type="hidden" name="countAdult" value="{{ $countAdult }}">
        <input type="hidden" name="countChild" value="{{ $countChild }}">
        <input type="hidden" name="countInfant" value="{{ $countInfant }}">

        @php
            $customerAdult = [];
            $customerChild = [];
            $customerInfant = [];
            
            $chairAdultReturn = [];
            $chairChildReturn = [];
            $chairInfantReturn = [];
            for ($i = 0; $i < $countAdult; $i++) {
                $customerAdult[] = [
                    'title' => $title_Adult[$i],
                    'firstName' => $firstName_Adult[$i],
                    'lastName' => $lastName_Adult[$i],
                    'birthday' => $year_Adult[$i] . '-' . $month_Adult[$i] . '-' . $day_Adult[$i],
                    'chair' => $chair_Adult[$i],
                ];
                $chairAdultReturn[] =['chair' => $chair_AdultReturn[$i]];
            }
            for ($i = 0; $i < $countChild; $i++) {
                $customerChild[] = [
                    'title' => $title_Child[$i],
                    'firstName' => $firstName_Child[$i],
                    'lastName' => $lastName_Child[$i],
                    'birthday' => $year_Child[$i] . '-' . $month_Child[$i] . '-' . $day_Child[$i],
                    'chair' => $chair_Child[$i],
                ];
                $chairChildReturn[] =['chair' => $chair_ChildReturn[$i]];
            }
            for ($i = 0; $i < $countInfant; $i++) {
                $customerInfant[] = [
                    'title' => $title_Infant[$i],
                    'firstName' => $firstName_Infant[$i],
                    'lastName' => $lastName_Infant[$i],
                    'birthday' => $year_Infant[$i] . '-' . $month_Infant[$i] . '-' . $day_Infant[$i],
                    'chair' => $chair_Infant[$i],
                ];
                $chairInfantReturn[] =['chair' => $chair_InfantReturn[$i]];
            }
        @endphp

        <input type="hidden" name="customerAdult" value="{{ json_encode($customerAdult)}}">
        <input type="hidden" name="customerChild" value="{{ json_encode($customerChild)}}">
        <input type="hidden" name="customerInfant" value="{{ json_encode($customerInfant)}}">
        <input type="hidden" name="chairAdultReturn" value="{{ json_encode($chairAdultReturn)}}">
        <input type="hidden" name="chairChildReturn" value="{{ json_encode($chairChildReturn)}}">
        <input type="hidden" name="chairInfantReturn" value="{{ json_encode($chairInfantReturn)}}">
    </form>

    <section class="select">
        <svg viewBox="25 25 50 50">
            <circle r="20" cy="50" cx="50"></circle>
        </svg>
        <p>Khi rời khỏi trang này các ghế số 
        @php
            $array_chair_number = [];
            $array_chairReturn_number = [];
        @endphp
    
        @for ($i = 0; $i < $countAdult; $i++)
            @php
                $array_chair_number[] = $chair_Adult[$i];
                $array_chairReturn_number[] = $chair_AdultReturn[$i];
            @endphp
        @endfor
    
        @for ($i = 0; $i < $countChild; $i++)
            @php
                $array_chair_number[] = $chair_Child[$i];
                $array_chairReturn_number[] = $chair_ChildReturn[$i];
            @endphp
        @endfor
    
        @for ($i = 0; $i < $countInfant; $i++)
            @php
                $array_chair_number[] = $chair_Infant[$i];
                $array_chairReturn_number[] = $chair_InfantReturn[$i];
            @endphp
        @endfor
    
        {{ implode(', ', $array_chair_number) }}
        {{ implode(', ', $array_chairReturn_number) }}
        mà bạn đã chọn sẽ bị Hủy và bạn phải thực hiện chọn lại ghế. Bạn có chắc muốn hủy thanh toán</p>
        <div>
            <button id="confirmCancel"
                data-flight-code="{{ $flight_code}}"
                data-flight-code-return="{{ $flight_codeReturn }}"
                data-chair-type="{{ $chairType }}"
                data-chair-numbers="{{ implode(',', $array_chair_number) }}"
                data-chair-return-numbers="{{ implode(',', $array_chairReturn_number) }}"
            >Có</button>
            <button onclick="closeItem()">Không</button>
        </div>      
    </section>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/pay.js') }}"></script>
</body>
</html>