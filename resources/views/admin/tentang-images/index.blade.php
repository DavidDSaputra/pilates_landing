@extends('layoutsadmin.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Kelola Gambar Halaman Tentang</h1>
            <a href="{{ route('admin.tentang-images.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Gambar
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="80">Preview</th>
                                <th>Judul</th>
                                <th>Section</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($images as $image)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->judul }}"
                                            class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong>{{ $image->judul }}</strong>
                                        @if($image->keterangan)
                                            <br>
                                            <small class="text-muted">{{ Str::limit($image->keterangan, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($image->section == 'story')
                                            <span class="badge bg-info">Cerita</span>
                                        @elseif($image->section == 'team')
                                            <span class="badge bg-success">Tim</span>
                                        @else
                                            <span class="badge bg-secondary">Lainnya</span>
                                        @endif
                                    </td>
                                    <td>{{ $image->urutan }}</td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-sm {{ $image->is_active ? 'btn-success' : 'btn-secondary' }} toggle-active"
                                            data-id="{{ $image->id }}" data-active="{{ $image->is_active ? 1 : 0 }}">
                                            <i class="fas fa-{{ $image->is_active ? 'check' : 'times' }}"></i>
                                            {{ $image->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.tentang-images.edit', $image->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if(auth()->user()->role === 'super_admin')
                                                <form action="{{ route('admin.tentang-images.destroy', $image->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                                        <p class="text-muted mt-3">Belum ada gambar. Klik tombol "Tambah Gambar" untuk
                                            menambahkan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $images->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('.toggle-active').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const isActive = this.dataset.active == 1;

                    fetch(`/admin/tentang-images/${id}/toggle-active`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                });
            });
        </script>
    @endpush
@endsection