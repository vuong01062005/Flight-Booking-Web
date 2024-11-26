<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountUser;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
           'userName' => 'required',
           'pass' => 'required', 
        ]);

        $userName = $request->userName;
        $password = $request->pass;

        $user = AccountUser::where('userName', $userName)->first();

        if ($user  && Hash::check($password, $user->password)) {
            session([
                'userID' => $user->id,
                'firstName' => $user->firstName,
                'lastName' => $user->lastName,
                'avatar' => $user->Avatar,
            ]);

            if ($user->id == 1)  {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Đăng nhập thành công',
                    'redirect' => route('admin'),
                ]);
            } else {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Đăng nhập thành công',
                    'redirect' => route('home'),
                ]);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Kiểm tra lại tên người dùng và mật khẩu!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home');
    }
}
