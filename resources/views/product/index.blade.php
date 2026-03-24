@extends('layout.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách Sản phẩm</h3>
                    <div class="card-tools">
                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Thêm mới
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('products.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="keyword" value="{{ $keyword }}"
                                    placeholder="Tìm theo tên sản phẩm...">
                            </div>
                            <div class="col-md-4">
                                <select name="category_id" class="form-control">
                                    <option value="">-- Tất cả danh mục --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 text-right">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-search"></i> Lọc
                                </button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 60px">ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Giá khuyến mãi</th>
                                <th>Tồn kho</th>
                                <th>Trạng thái</th>
                                <th style="width: 130px">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category?->name ?? '-' }}</td>
                                    <td>{{ number_format((float) $product->price, 2) }}</td>
                                    <td>{{ $product->sale_price !== null ? number_format((float) $product->sale_price, 2) : '-' }}
                                    </td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if ($product->is_active)
                                            <span class="badge badge-success">Kích hoạt</span>
                                        @else
                                            <span class="badge badge-secondary">Ẩn</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Không có sản phẩm nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
