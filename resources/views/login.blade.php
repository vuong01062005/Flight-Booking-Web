<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        /* Modal background */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 50px;
        }
        
        .modal-dialog {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .modal-content {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .modal-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }
        
        .modal-header h5 {
            margin: 0;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }
        
        .modal-header i {
            font-size: 1.5rem;
            margin-right: 10px;
        }
        
        .btn-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        .btn-outline-dark {
            background-color: transparent;
            border: 1px solid #007bff;
            color: #007bff;
        }
        
        .btn-outline-dark:hover {
            background-color: #007bff;
            color: white;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-secondary {
            color: #6c757d;
        }
        
        .btn.text-secondary {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: end;
        }
        
        .mb-2 {
            margin-bottom: 10px;
        }
        
        .mb-3 {
            margin-bottom: 15px;
        }
        
        .mb-4 {
            margin-bottom: 20px;
        }
        
        .mb-5 {
            margin-bottom: 25px;
        }
        
        .modal.show {
            display: block;
        }
        
    </style>
</head>
<body>
    <div class="modal" id="loginModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="login-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i> User Login</h5>
                        <button type="button" class="btn-close" onclick="closeModal()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">User Name</label>
                            <input type="text" name="userName_login" class="form-control" required>          
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass_login" class="form-control" required>          
                        </div>
                        <div class="btn-group mb-2">
                            <button type="submit" class="btn btn-dark">LOGIN</button>
                            <button type="button" class="btn text-secondary" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal" onclick="showForgotPasswordModal()">
                            Forgot Password?
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function openModal() {
            document.getElementById('loginModal').classList.add('show');
        }
    
        function closeModal() {
            document.getElementById('loginModal').classList.remove('show');
        }
    
        $('#login-form').on('submit', function(e) {
            e.preventDefault();
    
            var userName = $('input[name="userName_login"]').val();
            var pass = $('input[name="pass_login"]').val();

            var formData = {
                userName: userName,
                pass: pass,
                _token: $('meta[name="csrf-token"]').attr('content')
            };
    
            $.ajax({
                url: '{{ route('login') }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value.join(', ') + '\n';
                        });
                        alert('Lỗi: \n' + errorMessage);
                    } else {
                        alert('Đã có lỗi xảy ra, vui lòng thử lại!');
                    }
                }
            })
        })
    </script>
</body>
</html>