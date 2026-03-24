@extends('layout.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách danh mục</h3>
        <a href="{{ route('category.create') }}" class="btn btn-primary float-right">
            Thêm mới
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="text-center">
                <tr>
                    <th width="5%">STT</th>
                    <th width="10%">ID</th>
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                    <th width="10%">Trạng thái</th>
                    <th width="20%">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $key => $cat)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>
                        {{ $cat->parent ? $cat->parent->name : '—' }}
                    </td>
                    <td class="text-center">
                        @if($cat->is_active)
                            <span class="badge badge-success">Hoạt động</span>
                        @else
                            <span class="badge badge-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('category.edit', $cat->id) }}"
                           class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <form action="{{ route('category.destroy', $cat->id) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Chưa có danh mục nào
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
