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
                <h2 class="fw-bold">Chỉnh sửa hồ sơ</h2>
                <div class="breadcrumb">
                    <a href="index.php">Trang chủ</a>
                    <span> &gt; </span>
                    <a href="#">Hồ sơ của tôi</a>
                </div>     
            </div>

            <!-- Profile Form -->
            <div class="col-12">
                <div class="bg-white">
                    <form id="info-form" method="POST" action="{{ route('updateInfo', ['id'=>$user->id]) }}">
                        @csrf
                        <h5>Thông tin của tôi</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Tên</label>
                                <input type="text" name="fname" value="{{ $user->firstName }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Họ</label>
                                <input type="text" name="lname" value="{{ $user->lastName }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Số điện thoại</label>
                                <input type="number" name="phone" value="{{ $user->Phone }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $user->Email }}" required>
                            </div>
                        </div>
                        <button type="submit">Lưu thay đổi</button>
                    </form>
                </div>           
            </div>

            <!-- Profile Image -->
            <div class="col-md-4">
                <div class="bg-white">
                    <form id="profile-form" method="post" enctype="multipart/form-data" action="{{ route('updateAvatar', ['id'=>$user->id]) }}">
                        @csrf
                        <h5>Hình ảnh</h5>
                        <img src="{{ asset('storage/' . $user->Avatar) }}">
                        <label>Hình ảnh mới</label>
                        <input name="avatar" type="file" accept=".jpg, .jpeg, .png, .webp" required> 
                        <button type="submit">Lưu thay đổi</button>
                    </form>
                </div>           
            </div>

            <!-- Password Change -->
            <div class="col-md-8">
                <div class="bg-white">
                    <form id="pass-form" method="POST" action="{{ route('updatePass', ['id'=>$user->id]) }}">
                        @csrf
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
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif


</body>
</html>

