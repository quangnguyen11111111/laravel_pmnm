<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
        public function login()
    {
        return view("auth.login");
    }

    public function checkLogin(Request $request)
    {
        if ($request->input('username') == 'quangnguyen' && $request->input('password') == '123456') {
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        } else {

            return redirect('/auth/login')->with('error', 'Sai tên đăng nhập hoặc mật khẩu!');
        }
    }
    public function register()
    {
        return view("auth.register");
    }

    public function checkRegister(Request $request)
    {   
        if ($request->input('password') !== $request->input('password_confirmation')) {
            return redirect('/auth/register')->with('error', 'Mật khẩu không khớp!');
        }
        elseif ($request->input('username') != 'nguyenvietquang' 
        || $request->input('student_id') != '0313767' 
        || $request->input('gender') != 'male' 
        || $request->input('class') != '67Pm2'
        ) {
            return redirect('/auth/register')->with('error', 'Thoong tin đăng ký không đúng!');
        }
        return redirect('/auth/login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}
