@extends('layoutsadmin.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Tambah Gambar Baru</h1>
        <a href="{{ route('admin.tentang-images.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tentang-images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('judul') is-invalid @enderror"
                                   id="judul"
                                   name="judul"
                                   value="{{ old('judul') }}"
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar <span class="text-danger">*</span></label>
                            <input type="file"
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image"
                                   accept="image/*"
                                   required
                                   onchange="previewImage(this)">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, WEBP. Max: 5MB</small>

                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                      id="keterangan"
                                      name="keterangan"
                                      rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="section" class="form-label">Section <span class="text-danger">*</span></label>
                            <select class="form-select @error('section') is-invalid @enderror"
                                    id="section"
                                    name="section"
                                    required>
                                <option value="">Pilih Section</option>
                                <option value="story" {{ old('section') == 'story' ? 'selected' : '' }}>Cerita Kami</option>
                                <option value="team" {{ old('section') == 'team' ? 'selected' : '' }}>Tim Kami</option>
                                <option value="other" {{ old('section') == 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('section')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Pilih di bagian mana gambar akan ditampilkan</small>
                        </div>

                        <div class="mb-3">
                            <label for="urutan" class="form-label">Urutan <span class="text-danger">*</span></label>
                            <input type="number"
                                   class="form-control @error('urutan') is-invalid @enderror"
                                   id="urutan"
                                   name="urutan"
                                   value="{{ old('urutan', 0) }}"
                                   min="0"
                                   required>
                            @error('urutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Angka kecil akan ditampilkan lebih dulu</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="is_active"
                                       name="is_active"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Aktif
                                </label>
                            </div>
                            <small class="text-muted">Gambar hanya akan ditampilkan jika aktif</small>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-3 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.tentang-images.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endpush
@endsection
