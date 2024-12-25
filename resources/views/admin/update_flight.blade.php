<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>
    @include('admin.header')
    <div class="container">
        @include('admin.sidebar')
        <div class="main">
            <div class="main_header">
                <h3>Thông tin chuyến bay</h3>
            </div>
            <div class="main_content">
                <form method="post" action="{{ route('update_flightInfo') }}">
                    @csrf
                    <div class="form-header">
                        <h2>Cập nhật thông tin chuyến bay</h2>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <label>Mã chuyến bay</label>
                            <p>{{ $flight->flight_code }}</p>
                            <input type="hidden" name="flight_code" id="flight_code" value="{{ $flight->flight_code }}">
                        </div>
                
                        <div class="form-group">
                            <label>Điểm đi</label>
                            <select name="departure_city" id="departure_city">
                                <option value="{{ $flight->departure_city }} {{ $flight->departure_cityName }}">Sân bay {{ $flight->departure_cityName }}</option>
                                <option value="HAN Hà Nội">Sân bay Nội Bài (HAN)</option>
                                <option value="SGN TP HCM">Sân bay Tân Sơn Nhất (SGN)</option>
                                <option value="DAD Đà Nẵng">Sân bay Đà Nẵng (DAD)</option>
                                <option value="VDO Quảng Ninh">Sân bay Vân Đồn (VDO)</option>
                                <option value="HPH Hải Phòng">Sân bay Cát Bì (HPH)</option>
                                <option value="VII Nghệ An">Sân bay Vinh (VII)</option>
                                <option value="HUI Huế">Sân bay Phú Bài (HUI)</option>
                                <option value="CXR Khánh Hòa">Sân bay Cam Ranh (CXR)</option>
                                <option value="DLI Lâm Đồng">Sân bay Liên Khương (DLI)</option>
                                <option value="UIH Bình Định">Sân bay Phù Cát (UIH)</option>
                                <option value="VCA Cần Thơ">Sân bay Cần Thơ (VCA)</option>
                                <option value="PQC Kiên Giang">Sân bay Phú Quốc (PQC)</option>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label>Điểm đến</label>
                            <select name="arrival_city" id="arrival_city">
                                <option value="{{ $flight->arrival_city }} {{ $flight->arrival_cityName }}">Sân bay {{ $flight->arrival_cityName }}</option>
                                <option value="HAN Hà Nội">Sân bay Nội Bài (HAN)</option>
                                <option value="SGN TP HCM">Sân bay Tân Sơn Nhất (SGN)</option>
                                <option value="DAD Đà Nẵng">Sân bay Đà Nẵng (DAD)</option>
                                <option value="VDO Quảng Ninh">Sân bay Vân Đồn (VDO)</option>
                                <option value="HPH Hải Phòng">Sân bay Cát Bì (HPH)</option>
                                <option value="VII Nghệ An">Sân bay Vinh (VII)</option>
                                <option value="HUI Huế">Sân bay Phú Bài (HUI)</option>
                                <option value="CXR Khánh Hòa">Sân bay Cam Ranh (CXR)</option>
                                <option value="DLI Lâm Đồng">Sân bay Liên Khương (DLI)</option>
                                <option value="UIH Bình Định">Sân bay Phù Cát (UIH)</option>
                                <option value="VCA Cần Thơ">Sân bay Cần Thơ (VCA)</option>
                                <option value="PQC Kiên Giang">Sân bay Phú Quốc (PQC)</option>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label>Ngày bay</label>
                            <input type="date" name="departure_date" id="departure_date" value="{{ $flight->flight_date }}">
                        </div>
                
                        <div class="form-group">
                            <label>Thời gian đi</label>
                            <input type="text" placeholder="HH:MM" id="departure_time" name="departure_time" value="{{ $flight->departure_time }}" required>
                        </div>
                
                        <div class="form-group">
                            <label>Thời gian đến</label>
                            <input type="text" placeholder="HH:MM" id="arrival_time" name="arrival_time" value="{{ $flight->arrival_time }}" required>
                        </div>
                
                        <div class="form-group">
                            <label>Thời gian bay</label>
                            <input type="text" id="time" name="time" value="{{ $flight->time }}">
                        </div>

                        <div class="form-group">
                            <label>trạng thái</label>
                            <input type="text" id="time" name="status" value="{{ $flight->status_flight }}">
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('departure_time').addEventListener('change', calculateDuration)
        document.getElementById('arrival_time').addEventListener('change', calculateDuration)
        function calculateDuration() {
            var a = document.getElementById('departure_time').value
            var b = document.getElementById('arrival_time').value
            
            if (a && b) {
                var [ah, am] = a.split(':')
                var [bh, bm] = b.split(':')
                if (parseInt(bm) - parseInt(am) < 0) {
                    var hours = parseInt(bh) - parseInt(ah) - 1
                    var minutes = parseInt(bm) - parseInt(am) + 60
                    document.getElementById('time').value = hours + 'h ' + minutes + 'm'
                } else if (parseInt(bm) - parseInt(am) >= 0 && parseInt(bm) - parseInt(am) >= 0) {
                    var hours = parseInt(bh) - parseInt(ah)
                    var minutes = parseInt(bm) - parseInt(am)
                    document.getElementById('time').value = hours + 'h ' + minutes + 'm'
                } else {
                    document.getElementById('time').value = '0'
                }
            }
        }
    </script>   
</body>
</html>