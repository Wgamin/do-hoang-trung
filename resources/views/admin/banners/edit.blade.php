<x-app-layout>
    <x-slot name="header">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <h2 class="fs-4 mb-0">Chỉnh sửa Banner</h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    id="title" name="title" value="{{ old('title', $banner->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Tiêu đề phụ</label>
                                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" 
                                    id="subtitle" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}">
                                @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh hiện tại</label>
                                <div class="mb-2">
                                    <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}" 
                                        class="img-thumbnail" style="height: 150px;">
                                </div>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                    id="image" name="image">
                                <div class="form-text">Để trống nếu không muốn thay đổi ảnh</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="order" class="form-label">Thứ tự hiển thị</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                    id="order" name="order" value="{{ old('order', $banner->order) }}">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="button_text" class="form-label">Nút nhấn (tùy chọn)</label>
                                <input type="text" class="form-control @error('button_text') is-invalid @enderror" 
                                    id="button_text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" 
                                    placeholder="Văn bản hiển thị trên nút">
                                @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="button_link" class="form-label">Liên kết nút (tùy chọn)</label>
                                <input type="text" class="form-control @error('button_link') is-invalid @enderror" 
                                    id="button_link" name="button_link" value="{{ old('button_link', $banner->button_link) }}" 
                                    placeholder="URL khi nhấn vào nút">
                                @error('button_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" 
                                    name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Hiển thị</label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Hủy</a>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>