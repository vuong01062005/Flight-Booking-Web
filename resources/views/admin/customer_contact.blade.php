@php
    use App\Models\ContactList;
    $ContactList = new ContactList();
@endphp
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
                <h3>Thông tin liên hệ</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Ảnh</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $contacts = $ContactList->customerContactList(1);
                        @endphp
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td><img src="{{ asset('storage/'. $contact->image_transfer) }}" alt="" onclick="openModal(this)"></td>
                                <td><a href="{{ route('admin-customer-ticketByID', ['id'=>$contact->id]) }}">Xem thông tin vé</a></td>
                                <td><a href="">Xóa</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <footer class="layout_table-footer">
                    <p>
                        Showing {{ $contacts->firstItem() }} - {{ $contacts->lastItem() }} of {{ $contacts->total() }} items
                    </p>
                    <ul>
                        <li>
                            @if ($contacts->onFirstPage())
                                <a><i class="fa fa-chevron-left"></i></a>
                            @else
                                <a href="{{ $contacts->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
                            @endif
                        </li>
                        @php
                            $currentPage = $contacts->currentPage();
                            $lastPage = $contacts->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);
                        @endphp
                        @if ($startPage > 1)
                            <li><a href="{{ $contacts->url(1) }}">1</a></li>
                            @if ($startPage > 2)
                                <li><span>...</span></li>
                            @endif
                        @endif
                
                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <li>
                                <a href="{{ $contacts->url($i) }}" class="{{ $currentPage == $i ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor
                        @if ($endPage < $lastPage)
                            @if ($endPage < $lastPage - 1)
                                <li><span>...</span></li>
                            @endif
                            <li><a href="{{ $contacts->url($lastPage) }}">{{ $lastPage }}</a></li>
                        @endif
                        <li>
                            @if ($contacts->hasMorePages())
                                <a href="{{ $contacts->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
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