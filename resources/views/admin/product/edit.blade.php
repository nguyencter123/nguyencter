@extends('layout.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Cập nhật sản phẩm</h3>
    </div>

    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- Tên --}}
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $product->name) }}">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Danh mục --}}
            <div class="form-group">
                <label>Danh mục</label>
                <select name="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Giá --}}
            <div class="form-group">
                <label>Giá</label>
                <input type="number"
                       step="0.01"
                       name="price"
                       class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price', $product->price) }}">

                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Giá khuyến mãi --}}
            <div class="form-group">
                <label>Giá khuyến mãi</label>
                <input type="number"
                       step="0.01"
                       name="sale_price"
                       class="form-control @error('sale_price') is-invalid @enderror"
                       value="{{ old('sale_price', $product->sale_price) }}">

                @error('sale_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Stock --}}
            <div class="form-group">
                <label>Số lượng</label>
                <input type="number"
                       name="stock"
                       class="form-control @error('stock') is-invalid @enderror"
                       value="{{ old('stock', $product->stock) }}">

                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Mô tả --}}
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description"
                          class="form-control"
                          rows="3">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Trạng thái --}}
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="is_active" class="form-control">
                    <option value="1"
                        {{ old('is_active', $product->is_active)==1?'selected':'' }}>
                        Hoạt động
                    </option>
                    <option value="0"
                        {{ old('is_active', $product->is_active)==0?'selected':'' }}>
                        Ẩn
                    </option>
                </select>
            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('product.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </div>
    </form>
</div>
@endsection
