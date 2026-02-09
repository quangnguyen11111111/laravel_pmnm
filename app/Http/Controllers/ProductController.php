<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index()
    {
        $title = "Product List";
        $products = Product::all();
        // return view("product.index", ["products" => $products]);
        return view("admin.product", ["products" => $products, "title" => $title]);
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


}