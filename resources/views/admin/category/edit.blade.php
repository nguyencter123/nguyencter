@extends('layout.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cập nhật danh mục</h3>
    </div>

    <form method="POST" action="{{ route('category.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- Tên danh mục --}}
            <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Mô tả --}}
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description"
                          class="form-control"
                          rows="3">{{ old('description', $category->description) }}</textarea>
            </div>

            {{-- Danh mục cha --}}
            <div class="form-group">
                <label>Danh mục cha</label>
                <select name="parent_id"
                        class="form-control @error('parent_id') is-invalid @enderror">
                    <option value="">-- Không có --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                @error('parent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Trạng thái --}}
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="is_active" class="form-control">
                    <option value="1"
                        {{ old('is_active', $category->is_active) == 1 ? 'selected' : '' }}>
                        Hoạt động
                    </option>
                    <option value="0"
                        {{ old('is_active', $category->is_active) == 0 ? 'selected' : '' }}>
                        Ẩn
                    </option>
                </select>
            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('category.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </div>
    </form>
</div>
@endsection
