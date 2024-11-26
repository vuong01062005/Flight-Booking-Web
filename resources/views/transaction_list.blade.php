<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giao dịch của tôi</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .header {
            font-size: 16px;
            color: #007bff;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Bộ lọc */
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filters button {
            padding: 8px 16px;
            border: 1px solid #007bff;
            background: #fff;
            border-radius: 5px;
            color: #007bff;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        .filters button.active {
            background: #007bff;
            color: #fff;
        }

        .filters button:hover {
            background: #0056b3;
            color: #fff;
        }

        /* Bộ lọc ngày */
        .date-input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-apply {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-apply:hover {
            background-color: #0056b3;
        }

        /* Kết quả */
        .empty-box {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .empty-box img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .result-item {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .result-item h3 {
            margin: 0 0 5px;
            color: #333;
        }

        .result-item p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        /* Liên kết đường dẫn */
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
<body>
    @include('elements.header')

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">Lịch sử giao dịch</h2>
                <div class="breadcrumb">
                    <a href="index.php">Trang chủ</a>
                    <span> &gt; </span>
                    <a href="#">Giao dịch của tôi</a>
                </div>     
            </div>       
            
            <div class="header">
                <span>Xem tất cả vé máy bay và phiếu thanh toán trong <a href="my_bookings.php">Đặt chỗ của tôi</a></span>
            </div>

            <div class="filters">
                <button class="filter-btn active" data-range="90-days">90 ngày qua</button>
                <button class="filter-btn" data-month="10-2024">Tháng 10 2024</button>
                <button class="filter-btn" data-month="9-2024">Tháng 9 2024</button>
                <button class="filter-btn" data-range="custom">Ngày tùy chọn</button>
            </div>

            <div id="custom-range" style="margin-top: 20px; display: none;">
                <label for="start-date">Từ:</label>
                <input type="date" id="start-date" class="date-input">
                <label for="end-date">Đến:</label>
                <input type="date" id="end-date" class="date-input">
                <button id="apply-filter" class="btn-apply">Lọc</button>
            </div>

            <div id="results">
                <div class="empty-box">
                    <img src="https://img.icons8.com/ios-filled/50/000000/sleeping-in-bed.png">
                    <p>Không tìm thấy giao dịch</p>
                    <p>
                        Không tìm thấy giao dịch cho sản phẩm bạn chọn. Đặt lại bộ lọc để xem tất cả giao dịch.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const filterButtons = document.querySelectorAll('.filter-btn');
        const customRange = document.getElementById('custom-range');

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                if (this.getAttribute('data-range') === 'custom') {
                    customRange.style.display = 'block';
                } else {
                    customRange.style.display = 'none';
                    fetchDataByFilter(this.getAttribute('data-range') || this.getAttribute('data-month'));
                }
            });
        });

        function fetchDataByFilter(filterType) {
            let url = `ajax/fetch_data.php?filter=${filterType}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('results');
                    resultsDiv.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            resultsDiv.innerHTML += `
                                <div class="result-item">
                                    <h3>${item.title}</h3>
                                    <p>Ngày: ${item.date}</p>
                                    <p>Giá: ${item.price} VNĐ</p>
                                </div>
                            `;
                        });
                    } else {
                        resultsDiv.innerHTML = `
                            <div class="empty-box">
                                <img src="https://img.icons8.com/ios-filled/50/000000/sleeping-in-bed.png">
                                <p>Không tìm thấy giao dịch</p>
                                <p>Đặt lại bộ lọc để xem tất cả giao dịch.</p>
                            </div>
                        `;
                    }
                })
                .catch(error => console.error('Lỗi:', error));
        }
    </script>
</body>
</html>