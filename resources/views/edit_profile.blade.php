<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILES</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">

    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(120deg, #fdfbfb, #ebedee);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
        }

        h2 {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #2980b9;
        }

        .bg-white {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .bg-white:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-weight: 600;
            font-size: 14px;
            color: #2c3e50;
        }

        input, textarea, button {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            font-weight: 600;
            text-transform: uppercase;
        }

        button:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }

        textarea {
            resize: none;
        }

        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid #3498db;
            transition: transform 0.3s;
        }

        img:hover {
            transform: scale(1.1);
        }

        /* Layout Columns */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .col-12 {
            width: 100%;
        }

        .col-md-4 {
            flex: 0 0 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
        }

        .col-md-6 {
            flex: 0 0 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }

        .col-md-8 {
            flex: 0 0 calc(66.666% - 20px);
            max-width: calc(66.666% - 20px);
        }

        

        .breadcrumb a {
            color: #6c757d;
            text-decoration: none;
        }

        .breadcrumb span {
            color: #6c757d;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .col-md-4, .col-md-6, .col-md-8 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    @include('elements.header')

    <div class="container">
        <div class="row">
            <!-- Page Header -->
            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">Lịch sử giao dịch</h2>
                <div class="breadcrumb">
                    <a href="index.php">Trang chủ</a>
                    <span> &gt; </span>
                    <a href="#">Giao dịch của tôi</a>
                </div>     
            </div>

            <!-- Profile Form -->
            <div class="col-12">
                <div class="bg-white">
                    <form id="info-form">
                        <h5>Thông tin của tôi</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Tên</label>
                                <input type="text" name="fname" value="{{ session('firstName') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Họ</label>
                                <input type="text" name="lname" value="{{ session('lastName') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Tên người dùng</label>
                                <input type="text" name="name" required>
                            </div>
                            <div class="col-md-4">
                                <label>Số điện thoại</label>
                                <input type="number" name="phonenum" required>
                            </div>
                            <div class="col-md-4">
                                <label>Ngày sinh</label>
                                <input type="date" name="dob" required>
                            </div>
                            <div class="col-md-8">
                                <label>Địa chỉ</label>
                                <textarea name="address" rows="1" required>đá</textarea>
                            </div>
                        </div>
                        <button type="submit">Lưu thay đổi</button>
                    </form>
                </div>           
            </div>

            <!-- Profile Image -->
            <div class="col-md-4">
                <div class="bg-white">
                    <form id="profile-form">
                        <h5>Hình ảnh</h5>
                        <img src="{{ asset('storage/' . session('avatar')) }}">
                        <label>Hình ảnh mới</label>
                        <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" required> 
                        <button type="submit">Lưu thay đổi</button>
                    </form>
                </div>           
            </div>

            <!-- Password Change -->
            <div class="col-md-8">
                <div class="bg-white">
                    <form id="pass-form">
                        <h5>Đổi mật khẩu</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Mật khẩu mới</label>
                                <input type="password" name="new_pass" required>
                            </div>
                            <div class="col-md-6">
                                <label>Xác nhận mật khẩu</label>
                                <input type="password" name="confirm_pass" required>
                            </div>
                        </div>
                        <button type="submit">Lưu thay đổi</button>
                    </form>
                </div>           
            </div>
        </div>
    </div>

<script>
    let info_form = document.getElementById('info-form');

    info_form.addEventListener('submit', (e) =>{
        e.preventDefault();

        let data = new FormData();
        data.append('info_form','');
        data.append('fname',info_form.elements['fname'].value);
        data.append('lname',info_form.elements['lname'].value);
        data.append('name',info_form.elements['name'].value);
        data.append('phonenum',info_form.elements['phonenum'].value);
        data.append('address',info_form.elements['address'].value);
        data.append('dob',info_form.elements['dob'].value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile.php", true);

        xhr.onload = function () {
            let response = this.responseText.trim();
            console.log(response);
            if(response == 'phone_already'){
                alert('error', "Phone number is already registered!");
            } else if(response == 0){
                alert('error', "No Changes Made!");
            }else{
                alert('success', 'Changes Success')
            }
        };

        xhr.send(data);
    });

    let profile_form = document.getElementById('profile-form');

    profile_form.addEventListener('submit', (e)=>{
        e.preventDefault();


        let data = new FormData();

        data.append('profile_form','');
        data.append('profile',profile_form.elements['profile'].files[0]);
        

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile.php", true);

        xhr.onload = function () {

            let response = this.responseText.trim();
            console.log(response);

            if(response === 'inv_img') {
                alert('error', "Only JPG, WEBP & PNG images are allowed");
            }
            else if(response === 'upd_failed') {
                alert('error', "Image upload failed");
            }
            else if(response == 0){
                alert('error', "Updation failed!");
            }
            else{
                window.location.href = window.location.pathname;
            }
        };

        xhr.send(data);
    });

    let pass_form = document.getElementById('pass-form');
    
    pass_form.addEventListener('submit', (e)=>{
        e.preventDefault();

        let new_pass = pass_form.elements['new_pass'].value;
        let confirm_pass = pass_form.elements['confirm_pass'].value;

        if(new_pass != confirm_pass){
            alert('error',"Password do not match!");
            return false;
        }


        let data = new FormData();

        data.append('pass_form','');
        data.append('new_pass',new_pass);
        data.append('confirm_pass',confirm_pass);
        

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile.php", true);

        xhr.onload = function () {

            let response = this.responseText.trim();
            //console.log(response);

            if(response === 'mismatch') {
                alert('error', "Password do not match!");
            }
            else if(response == 0){
                alert('error', "Updation failed!");
            }
            else{
                alert('success',"Changes Saved");
                pass_form.reset();
            }
        };

        xhr.send(data);
    });
    
</script>

</body>
</html>

