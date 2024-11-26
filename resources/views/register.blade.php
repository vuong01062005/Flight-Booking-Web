<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        .modal_register {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 10px;
        }
        
        .modal_register-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 800px;
        }
        
        .register_form-header, .register_form-body {
            padding: 20px;
        }
        
        .register_form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }
        
        .register_form-header h5 {
            margin: 0;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }
        
        .register_form-header .close {
            font-size: 1.5rem;
            border: none;
            background: none;
            cursor: pointer;
        }
        
        .register_form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        
        .register_form-input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        
        .register_form-input:focus {
            border-color: #007bff;
            outline: none;
        }
        
        .register_form-container {
            display: flex;
            flex-wrap: wrap;
        }
        
        .register_form-col6 {
            width: 48%;
            padding-right: 1%;
            margin-bottom: 15px;
        }
        
        .register_form-col12 {
            width: 100%;
            margin-bottom: 15px;
        }
        
        .register_form-col12 p-0 {
            margin: 0;
        }
        
        .text-center {
            text-align: center;
        }
        .text-center button {
            height: 50px;
        }
        
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        .register_form-body {
            padding-bottom: 20px;
        }
        
        .register_form-input-group {
          display: flex;
          justify-content: center;
          gap: 10px
        }
        
        .register_form-input-group button {
          font-size: 16px;
          background-color: #007bff;
          color: white;
          border: none;
          cursor: pointer;
          border-radius: 5px;
        }
        
        .register_form-input-group button:hover {
          background-color: #0056b3;
        }
        
        @media (max-width: 768px) {
            .col-md-6 {
            width: 100%;
            padding-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="modal_register" id="registerModal">
        <div class="modal_register-content">
            <form id="register_form" enctype="multipart/form-data">
                @csrf
                <div class="register_form-header">
                    <h5 class="modal-title"><i class="bi bi-person-add"></i> User Registration</h5>
                    <button type="button" class="close" onclick="closeModalRegister()">×</button>
                </div>
                <div class="register_form-body">
                    <div class="register_form-container">
                        <div class="register_form-col6">
                            <label class="register_form-label">First Name</label>
                            <input name="firstName" type="text" class="register_form-input" required>
                        </div>
    
                        <div class="register_form-col6">
                            <label class="register_form-label">Last Name</label>
                            <input name="lastName" type="text" class="register_form-input" required>
                        </div>
    
                        <div class="register_form-col6">
                            <label class="register_form-label">Username</label>
                            <input name="userName" type="text" class="register_form-input" required>
                        </div>
    
                        <div class="register_form-col6">
                            <label class="register_form-label">Email</label>
                            <input name="email" type="email" class="register_form-input" required>
                        </div>
    
                        <div class="register_form-col6">
                            <label class="register_form-label">Phone Number</label>
                            <input name="phone" type="number" class="register_form-input" required>
                        </div>
    
                        <div class="register_form-col6">
                            <label class="register_form-label">Date of Birth</label>
                            <input name="birthDay" type="date" class="register_form-input" required>
                        </div>
    
                        <div class="register_form-col12">
                            <label class="register_form-label">Enter Code</label>
                            <div class="register_form-input-group">
                                <input name="verification_code" type="text" class="register_form-input" required placeholder="Enter the verification code">
                                <button type="button" class="btn" id="sendCode">Send Code</button>
                            </div>
                        </div>
    
                        <div class="register_form-col12">
                            <label class="register_form-label">Avatar</label>
                            <input name="avatar" type="file" class="register_form-input" required>
                        </div>
    
                        <div class="register_form-col6">
                            <label class="register_form-label">Password</label>
                            <input name="pass" type="password" class="register_form-input" required>
                        </div>
                        
                        <div class="register_form-col6">
                            <label class="register_form-label">Confirm Password</label>
                            <input name="cpass" type="password" class="register_form-input" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn">REGISTER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function closeModalRegister() {
            document.getElementById('registerModal').style.display = 'none';
            document.body.style.overflow = 'visible'
        }
        
        function showModalRegister() {
            document.getElementById('registerModal').style.display = 'block';
            document.body.style.overflow = 'hidden'
        }

        $('#sendCode').on('click', function (e) {
            e.preventDefault();

            var email = $('input[name="email"]').val();

            if (!email) {
                alert('Vui lòng nhập gmail của bạn!');
                return;
            }

            var formData = {
                email: email,
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '{{ route('send.verification.code') }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    alert(response.message);
                },
                error: function () {
                    alert('An error occurred. Please try again.');
                }
            });
        });

        $('#register_form').on('submit', function (e) {
            e.preventDefault();

            var firstName = $('input[name="firstName"]').val();
            var lastName = $('input[name="lastName"]').val();
            var userName = $('input[name="userName"]').val();
            var email = $('input[name="email"]').val();
            var phone = $('input[name="phone"]').val();
            var birthDay = $('input[name="birthDay"]').val();
            var verification_code = $('input[name="verification_code"]').val();
            var avatar = $('input[name="avatar"]')[0].files[0];
            var pass = $('input[name="pass"]').val();
            var cpass = $('input[name="cpass"]').val();

            var formData = new FormData();
            formData.append('firstName', firstName);
            formData.append('lastName', lastName);
            formData.append('userName', userName);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('birthDay', birthDay);
            formData.append('verification_code', verification_code);
            formData.append('avatar', avatar);
            formData.append('pass', pass);
            formData.append('cpass', cpass);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.ajax({
                url: '{{ route('verify.code') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response.message);

                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                    if (errors) {
                        let errorMessage = Object.values(errors).map(err => err.join(', ')).join('\n');
                        alert('Error: \n' + errorMessage);
                    } else {
                        alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                    }
                }
            });
        });
    </script>
</body>
</html>