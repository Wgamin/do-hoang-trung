<x-app-layout>
    <x-slot name="header">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 text-secondary">
                {{ __('Quản lý Dịch vụ') }}
            </h2>
            <a href="{{ route('admin.service-cards.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Thêm mới
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
                                    <th>Loại dịch vụ</th>
                                    <th>Điểm đón</th>
                                    <th>Điểm đến</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($serviceCards as $serviceCard)
                                    <tr>
                                        <td>
                                            @if($serviceCard->main_image)
                                                <div class="position-relative overflow-hidden" style="width: 120px; height: 80px; border-radius: 4px;">
                                                    <img src="{{ Storage::url($serviceCard->main_image) }}" 
                                                        alt="{{ $serviceCard->pickup_point }} - {{ $serviceCard->destination }}" 
                                                        class="w-100 h-100 object-fit-cover">
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center justify-content-center bg-light" style="width: 120px; height: 80px; border-radius: 4px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $serviceCard->serviceType ? $serviceCard->serviceType->name : 'Không có' }}</td>
                                        <td>{{ $serviceCard->pickup_point }}</td>
                                        <td>{{ $serviceCard->destination }}</td>
                                        <td>{{ $serviceCard->formatted_price }}</td>
                                        <td>
                                            <span class="badge {{ $serviceCard->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $serviceCard->is_active ? 'Hiện' : 'Ẩn' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('service.show', $serviceCard) }}" 
                                                    class="btn btn-sm btn-info me-1" target="_blank">
                                                    <i class="fas fa-eye"></i> Xem
                                                </a>
                                                <a href="{{ route('admin.service-cards.edit', $serviceCard) }}" 
                                                    class="btn btn-sm btn-primary me-1">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <form action="{{ route('admin.service-cards.destroy', $serviceCard) }}" 
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Bạn có chắc muốn xóa dịch vụ này?')">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">
                                            Chưa có dịch vụ nào
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