@extends('layout.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Danh sách sản phẩm</h3>
        <a href="{{ route('product.create') }}" class="btn btn-primary float-right">
            Thêm mới
        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Giá KM</th>
                    <th>Stock</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '—' }}</td>
                    <td>{{ number_format($product->price) }}</td>
                    <td>{{ number_format($product->sale_price) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @if($product->is_active)
                            <span class="badge badge-success">Hoạt động</span>
                        @else
                            <span class="badge badge-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('product.edit', $product->id) }}"
                           class="btn btn-warning btn-sm">Sửa</a>

                        <form action="{{ route('product.destroy', $product->id) }}"
                              method="POST"
                              style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
