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
                <h3>Thông tin tài khoản</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Ảnh</th>
                            <th>Birthday</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $account)
                            <tr>
                                <td>{{ $account->firstName }} {{ $account->lastName }} </td>
                                <td>{{ $account->Phone }}</td>
                                <td>{{ $account->Email }}</td>
                                <td>{{ $account->BirthDay }}</td>
                                <td><img src="{{ asset('storage/'. $account->Avatar) }}" alt="" onclick="openModal(this)"></td>
                                <td><a href="{{ route('admin-customer-ticketByID', ['id'=>$account->id]) }}">Xem thông tin vé</a></td>
                                <td><a href="">Xóa</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <footer class="layout_table-footer">
                    <p>
                        Showing {{ $accounts->firstItem() }} - {{ $accounts->lastItem() }} of {{ $accounts->total() }} items
                    </p>
                    <ul>
                        <li>
                            @if ($accounts->onFirstPage())
                                <a><i class="fa fa-chevron-left"></i></a>
                            @else
                                <a href="{{ $accounts->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                            @endif
                        </li>
                        @php
                            $currentPage = $accounts->currentPage();
                            $lastPage = $accounts->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);
                        @endphp
                        @if ($startPage > 1)
                            <li><a href="{{ $accounts->url(1) }}">1</a></li>
                            @if ($startPage > 2)
                                <li><span>...</span></li>
                            @endif
                        @endif
                
                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <li>
                                <a href="{{ $accounts->url($i) }}" class="{{ $currentPage == $i ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor
                        @if ($endPage < $lastPage)
                            @if ($endPage < $lastPage - 1)
                                <li><span>...</span></li>
                            @endif
                            <li><a href="{{ $accounts->url($lastPage) }}">{{ $lastPage }}</a></li>
                        @endif
                        <li>
                            @if ($accounts->hasMorePages())
                                <a href="{{ $accounts->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
                            @else
                                <a><i class="fa fa-chevron-right"></i></a>
                            @endif
                        </li>
                    </ul>
                </footer>
                <div class="layout_table-imageModal">
                    <img src="accounts" alt="">
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