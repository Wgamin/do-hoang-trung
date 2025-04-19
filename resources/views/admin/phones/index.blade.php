<x-app-layout>
    <x-slot name="header">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 text-secondary">
                {{ __('Quản lý Số điện thoại') }}
            </h2>
            <a href="{{ route('admin.phones.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Thêm mới
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phones as $phone)
                                <tr>
                                    <td>{{ $phone->name }}</td>
                                    <td>{{ $phone->phone_number }}</td>
                                    <td>
                                        <span class="badge {{ $phone->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $phone->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.phones.edit', $phone) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                            <form action="{{ route('admin.phones.destroy', $phone) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>