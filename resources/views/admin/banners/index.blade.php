<x-app-layout>
    <x-slot name="header">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 text-secondary">
                {{ __('Quản lý Banner') }}
            </h2>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Thêm Banner Mới
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Thứ tự</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banners as $banner)
                                <tr>
                                    <td>
                                        @if($banner->image)
                                        <div class="position-relative overflow-hidden" style="width: 120px; height: 80px; border-radius: 4px;">
                                            <img src="{{ Storage::url($banner->image) }}"
                                                alt="{{ $banner->title }}"
                                                class="w-100 h-100 object-fit-cover">
                                        </div>
                                        @else
                                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 120px; height: 80px; border-radius: 4px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" class="text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ $banner->title }}</div>
                                        <div class="small text-muted">{{ $banner->subtitle }}</div>
                                    </td>
                                    <td>{{ $banner->order }}</td>
                                    <td>
                                        <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $banner->is_active ? 'Hiện' : 'Ẩn' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.banners.edit', $banner) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                            <form action="{{ route('admin.banners.destroy', $banner) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Bạn có chắc muốn xóa banner này?')">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        Chưa có banner nào
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>