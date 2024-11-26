<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>
    @include('admin.header')

    <section class="container">
        @include('admin.sidebar')
        <section class="main">
            <div class="main_header">
                <h3>Thông tin khách hàng</h3>
            </div>
            <section class="layout_table">
                <h3>Thông tin vé</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Ngày Sinh</th>
                            <th>Loại vé</th>
                            <th>Mã máy bay</th>
                            <th>Số ghế</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->title }} {{ $customer->first_name }} {{ $customer->last_name }}</td>
                            <td>{{ $customer->birthday }}</td>
                            <td>{{ $customer->customer_type }}</td>
                            <td>{{ $customer->flight_code }}</td>
                            <td>{{ $customer->chair_number }}</td>
                            <td><a href="{{ route('admin-customer-contactByID', ['id'=>$customer->id_contact]) }}">Liên hệ</a></td>
                            <td><a href="">Xóa</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <footer class="layout_table-footer">
                    <p>
                        Showing {{ $customers->firstItem() }} - {{ $customers->lastItem() }} of {{ $customers->total() }} items
                    </p>
                    <ul>
                        <li>
                            @if ($customers->onFirstPage())
                                <a><i class="fa fa-chevron-left"></i></a>
                            @else
                                <a href="{{ $customers->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                            @endif
                        </li>
                        @php
                            $currentPage = $customers->currentPage();
                            $lastPage = $customers->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);
                        @endphp
                        @if ($startPage > 1)
                            <li><a href="{{ $customers->url(1) }}">1</a></li>
                            @if ($startPage > 2)
                                <li><span>...</span></li>
                            @endif
                        @endif
                
                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <li>
                                <a href="{{ $customers->url($i) }}" class="{{ $currentPage == $i ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor
                        @if ($endPage < $lastPage)
                            @if ($endPage < $lastPage - 1)
                                <li><span>...</span></li>
                            @endif
                            <li><a href="{{ $customers->url($lastPage) }}">{{ $lastPage }}</a></li>
                        @endif
                        <li>
                            @if ($customers->hasMorePages())
                                <a href="{{ $customers->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                            @else
                                <a><i class="fa fa-chevron-right"></i></a>
                            @endif
                        </li>
                    </ul>
                </footer>
                <div class="layout_table-imageModal">
                    <img src="contacts" alt="">
                    <span class="layout_table-imageModal-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></span>
                </div>
            </section> 
        </section>
    </section>

    <section id="draggable" class="draggable">
        Kéo tôi đi xung quanh!
    </section>



    <script>
        function openModal(imgElement) {
            const modal = document.querySelector(".layout_table-imageModal");
            const modalImg = document.querySelector(".layout_table-imageModal img");
            modal.style.display = "flex";

            modalImg.src = imgElement.src;
            document.body.style.overflow = "hidden";
        }

        function closeModal() {
            // Ẩn modal
            const modal = document.querySelector(".layout_table-imageModal");
            modal.style.display = "none";
            document.body.style.overflow = "visible";
        }
    </script>
</body>
</html>