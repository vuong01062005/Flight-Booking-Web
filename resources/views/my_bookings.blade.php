<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giao dịch của tôi</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <title>Đặt chỗ của tôi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
        }

        .header a {
            color: yellow;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table thead tr {
            background-color: #007bff;
            color: white;
        }

        .table th, 
        .table td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .empty-box {
            text-align: center;
            margin: 20px 0;
        }

        .empty-box img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .empty-box p {
            font-size: 16px;
            font-weight: bold;
        }

        .transaction-history {
            border-top: 1px solid #ddd;
            margin-top: 20px;
            padding-top: 10px;
        }

        .breadcrumb {
            font-size: 14px;
            margin-bottom: 20px;
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
    </style>

</head>
<body class="bg-light">
    @include('elements.header')

    <div class="container">
        <div class="col-12 my-5 px-4">
            <h2 class="fw-bold">Đặt chỗ</h2>
            <div class="breadcrumb">
                <a href="index.php">Trang chủ </a>
                <span> &gt;&gt; </span>
                <a href="#"> Đặt chỗ của tôi</a>
            </div>     
        </div>  

        <div class="header">
            <h1>Du lịch dễ dàng</h1>
            <p>Đổi lịch dễ như trở bàn tay. <a href="#">Tìm hiểu thêm</a></p>
        </div>

        <div class="content">
            <h2>Vé điện tử</h2>
            {{-- <?php if ($result->num_rows > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Liên hệ</th>
                            <th>Mã chuyến bay</th>
                            <th>Tên chuyến bay</th>
                            <th>Ngày bay</th>
                            <th>Thời gian</th>
                            <th>Số ghế</th>
                            <th>Điểm đi - Điểm đến</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td>
                                    <?php echo $row['contact_first_name'] . ' ' . $row['contact_last_name'] . '<br>' . $row['account_email'] . '<br>' . $row['account_phone']; ?>
                                </td>
                                <td><?php echo $row['flight_code']; ?></td>
                                <td><?php echo $row['flight_name']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['flight_date'])); ?></td>
                                <td><?php echo $row['departure_time'] . ' - ' . $row['arrival_time']; ?></td>
                                <td><?php echo $row['chair_number']; ?></td>
                                <td><?php echo $row['departure_cityName'] . ' - ' . $row['arrival_cityname']; ?></td>
                                <td><button class="btn-danger">Cancel</button></td>
                            </tr>
                        <?php 
                            $i++;    
                        endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-box">
                    <img src="https://img.icons8.com/ios-filled/50/000000/sleeping-in-bed.png">
                    <p>Không tìm thấy đặt chỗ</p>
                    <p>Mọi chỗ bạn đặt sẽ được hiển thị tại đây. Hiện bạn chưa có bất kỳ đặt chỗ nào, hãy đặt trên trang chủ ngay!</p>
                </div>
            <?php endif; ?> --}}
        </div>

        <div class="transaction-history">
            <h2>Lịch sử giao dịch</h2>
            <a href="transaction_list.php">Xem Lịch sử giao dịch của bạn</a>
        </div>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
</body>

</html>

