<x-app-layout>
    <x-slot name="header">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <h2 class="h4 mb-0">Sửa số điện thoại</h2>
    </x-slot>

    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.phones.update', $phone) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $phone->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $phone->phone_number }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Trạng thái</label>
                        <select class="form-select" id="is_active" name="is_active">
                            <option value="1" {{ $phone->is_active ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ !$phone->is_active ? 'selected' : '' }}>Không hoạt động</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('admin.phones.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>