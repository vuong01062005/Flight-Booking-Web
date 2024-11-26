<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Models\AccountUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $verificationCode = Str::random(6);

        session(['verification_code' => $verificationCode]);

        Mail::raw("Mã xác thực của bạn là: $verificationCode", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Your Verification Code');
        });

        return response()->json(['message' => 'Mã xác thực đã gửi thành công!']);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'userName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthDay' => 'required',
            'verification_code' => 'required',
            'avatar' => 'required',
            'pass' => 'required',
            'cpass' => 'required',
        ]);

        $verificationCode = session('verification_code');
        
        if ($request->pass !== $request->cpass) {
            return response()->json([
                'message' => 'Mật khẩu không khớp!',
            ]);
        }
        if ($request->verification_code == $verificationCode) {
            $request->session()->forget('verification_code');

            if ($request->hasFile('avatar')) {
                $icon = $request->file('avatar')->store('images', 'public');
            } else {
                return response()->json([
                    'message' => 'Cần phải có file ảnh.'
                ]);
            }

            try {
                AccountUser::create([
                    'firstName' => $request->firstName,
                    'lastName' => $request->lastName,
                    'userName' => $request->userName,
                    'Email' => $request->email,
                    'Phone' => $request->phone,
                    'BirthDay' => $request->birthDay,
                    'Avatar' => $icon,
                    'password' => bcrypt($request->pass),
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Lỗi khi tạo người dùng: ' . $e->getMessage(),
                ]);
            }
            

            return response()->json([
                'message' => 'Đăng ký tài khoản thành công!',
                'redirect' => route('home')
            ]);
        } else {
            return response()->json([
                'message' => 'Mã xác thực không đúng!',
            ]);
        }
    }
}