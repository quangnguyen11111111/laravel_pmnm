<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Quản lý Sản phẩm';
        $keyword = request('keyword');
        $categoryId = request('category_id');

        $products = Product::with('category')
            ->where('is_delete', false)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::where('is_delete', false)
            ->orderBy('name')
            ->get();

        return view('product.index', compact('title', 'products', 'categories', 'keyword', 'categoryId'));
    }

    public function create()
    {
        $title = 'Thêm mới Sản phẩm';
        $categories = Category::where('is_delete', false)
            ->orderBy('name')
            ->get();

        return view('product.create', compact('title', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_delete'] = false;

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function edit(Product $product)
    {
        if ($product->is_delete) {
            abort(404);
        }

        $title = 'Chỉnh sửa Sản phẩm';
        $categories = Category::where('is_delete', false)
            ->orderBy('name')
            ->get();

        return view('product.edit', compact('title', 'product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->is_delete) {
            abort(404);
        }

        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function destroy(Product $product)
    {
        if ($product->is_delete) {
            return redirect()->route('products.index');
        }

        $product->update(['is_delete' => true]);

        return redirect()->route('products.index')
            ->with('success', 'Sản phẩm đã được xóa thành công.');
    }


}