<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $title = "Product List";
        return view("product.index", [
            "title" => $title,

            "products" => [
                [
                    "id" => 1,
                    'name' => "Product A",
                    'price' => 100,
                    'description' => "Description for Product A"
                ],
                [
                    "id" => 2,
                    'name' => "Product B",
                    'price' => 200,
                    'description' => "Description for Product B"
                ],
                [
                    "id" => 3,
                    'name' => "Product C",
                    'price' => 300,
                    'description' => "Description for Product C"
                ],
            ]
        ]);
    }

    public function getDetail($id = 123)
    {
        return view("product.product_detail", [
            "id" => $id
        ]);
    }

    public function create()
    {
        return view("product.add");
    }

    public function store(Request $request)
    {
        var_dump($request->input('name'));
    }

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

    public function checkRegister()
    {
        return redirect('/auth/login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}