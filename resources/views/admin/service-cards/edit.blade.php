<x-app-layout>
    <x-slot name="header">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
        <h2 class="fs-4 mb-0">Chỉnh sửa Dịch vụ</h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.service-cards.update', $serviceCard) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Cột trái -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="service_type_id" class="form-label fw-bold">Loại dịch vụ</label>
                                        <select class="form-select @error('service_type_id') is-invalid @enderror"
                                            id="service_type_id" name="service_type_id">
                                            <option value="">Chọn loại dịch vụ</option>
                                            @foreach($serviceTypes as $serviceType)
                                            <option value="{{ $serviceType->id }}"
                                                {{ old('service_type_id', $serviceCard->service_type_id) == $serviceType->id ? 'selected' : '' }}>
                                                {{ $serviceType->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('service_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="pickup_point" class="form-label fw-bold">Điểm đón</label>
                                        <input type="text" class="form-control @error('pickup_point') is-invalid @enderror"
                                            id="pickup_point" name="pickup_point" value="{{ old('pickup_point', $serviceCard->pickup_point) }}">
                                        @error('pickup_point')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="destination" class="form-label fw-bold">Điểm đến</label>
                                        <input type="text" class="form-control @error('destination') is-invalid @enderror"
                                            id="destination" name="destination" value="{{ old('destination', $serviceCard->destination) }}">
                                        @error('destination')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="price" class="form-label fw-bold">Giá dịch vụ (K)</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            id="price" name="price" value="{{ old('price', $serviceCard->price) }}">
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="phone_id" class="form-label fw-bold">Số điện thoại liên hệ</label>
                                        <select class="form-select @error('phone_id') is-invalid @enderror"
                                            id="phone_id" name="phone_id">
                                            <option value="">Chọn số điện thoại</option>
                                            @foreach($phones as $phone)
                                            <option value="{{ $phone->id }}"
                                                {{ old('phone_id', $serviceCard->phone_id) == $phone->id ? 'selected' : '' }}>
                                                {{ $phone->phone_number }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('phone_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Cột phải -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="main_image" class="form-label fw-bold">Ảnh chính</label>
                                        @if($serviceCard->main_image)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($serviceCard->main_image) }}"
                                                alt="Ảnh chính" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                        @endif
                                        <input type="file" class="form-control @error('main_image') is-invalid @enderror"
                                            id="main_image" name="main_image">
                                        <div class="form-text">Để trống nếu không muốn thay đổi ảnh</div>
                                        @error('main_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="secondary_image" class="form-label fw-bold">Ảnh phụ</label>
                                        @if($serviceCard->secondary_image)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($serviceCard->secondary_image) }}"
                                                alt="Ảnh phụ" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                        @endif
                                        <input type="file" class="form-control @error('secondary_image') is-invalid @enderror"
                                            id="secondary_image" name="secondary_image">
                                        <div class="form-text">Để trống nếu không muốn thay đổi ảnh</div>
                                        @error('secondary_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="description" class="form-label fw-bold">Nội dung chi tiết</label>
                                        <textarea id="description" name="description" class="form-control">{{ old('description', $serviceCard->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="is_active"
                                                name="is_active" value="1" {{ old('is_active', $serviceCard->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="is_active">Hiển thị</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <a href="{{ route('admin.service-cards.index') }}" class="btn btn-secondary px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i>Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thay đổi phần script CKEditor -->
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                height: '400px',
                removePlugins: ['restrictedEditingException', 'MarkerHighlight'],
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', '|', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>