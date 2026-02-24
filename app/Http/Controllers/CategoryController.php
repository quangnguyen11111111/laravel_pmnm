<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $title = 'Quản lý Danh mục';
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->where('is_delete', false)
            ->get();

        return view('category.index', compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $title = 'Thêm mới Danh mục';
        $parentCategories = Category::whereNull('parent_id')
            ->where('is_delete', false)
            ->get();

        return view('category.create', compact('parentCategories', 'title'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Danh mục đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        $title = 'Chỉnh sửa Danh mục';
        
        // Lấy tất cả ID của category con (con cháu)
        $descendantIds = $this->getAllDescendantIds($category);
        $excludeIds = array_merge([$category->id], $descendantIds);

        // Lấy danh sách parent categories, loại trừ category hiện tại và con cháu của nó
        $parentCategories = Category::whereNull('parent_id')
            ->where('is_delete', false)
            ->whereNotIn('id', $excludeIds)
            ->get();

        return view('category.edit', compact('category', 'parentCategories', 'title'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Lấy tất cả ID của category con (con cháu)
        $descendantIds = $this->getAllDescendantIds($category);
        $excludeIds = array_merge([$category->id], $descendantIds);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                Rule::notIn($excludeIds), // Không cho phép chọn chính nó hoặc con cháu
            ],
            'is_active' => 'boolean',
        ], [
            'parent_id.not_in' => 'Không thể chọn chính danh mục này hoặc danh mục con của nó làm danh mục cha.',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    /**
     * Soft delete the specified category.
     */
    public function destroy(Category $category)
    {
        $category->update(['is_delete' => true]);

        // Soft delete children as well
        $category->children()->update(['is_delete' => true]);

        return redirect()->route('categories.index')
            ->with('success', 'Danh mục đã được xóa thành công.');
    }

    /**
     * Lấy tất cả ID của các category con (con cháu - đệ quy)
     */
    private function getAllDescendantIds(Category $category): array
    {
        $ids = [];
        
        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getAllDescendantIds($child));
        }
        
        return $ids;
    }
}
