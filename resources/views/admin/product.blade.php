@extends('layout.admin', ['title' => $title])
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td class="price">${{ number_format($product['price'], 2) }}</td>
                    <td>{{ $product['stock'] }}</td>
                    <td>
                        <a href="" class="action-link edit-link">Edit</a>
                        <a href="" class="action-link delete-link"
                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection