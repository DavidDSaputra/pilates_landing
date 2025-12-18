@extends('layoutsadmin.app')
@section('title', 'Manajemen Testimoni')
@section('page-title', 'Manajemen Testimoni')

@section('content')
    <!-- Header Section -->
    <div class="mb-6 animate-fade-in-up">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-blue-400">Testimoni</h2>
                <p class="text-sm theme-text-secondary mt-1">Kelola testimoni pelanggan</p>
            </div>
            <a href="{{ route('admin.testimoni.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-gradient-primary hover:shadow-lg hover:shadow-blue-500/30 text-white font-medium rounded-lg transition-all duration-300 transform hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Testimoni</span>
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="mb-6 bg-green-500/10 border border-green-500/50 rounded-lg p-4 shadow-sm animate-fade-in-up">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <p class="text-green-500 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Main Content Card -->
    <div
        class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl shadow-2xl overflow-hidden animate-fade-in-up delay-100">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y theme-divide">
                <thead class="theme-bg-secondary">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                            Foto
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                            Nama
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                            Pekerjaan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                            Testimoni
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                            Rating
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-semibold theme-text-primary uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y theme-divide">
                    @forelse($testimonis as $testimoni)
                        <tr class="hover:bg-blue-400/5 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($testimoni->foto)
                                    <img src="{{ Storage::url($testimoni->foto) }}" alt="{{ $testimoni->nama }}"
                                        class="h-12 w-12 rounded-full object-cover ring-2 ring-blue-400/30 theme-border border">
                                @else
                                    <div
                                        class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold theme-text-primary">{{ $testimoni->nama }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm theme-text-secondary">{{ $testimoni->pekerjaan ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm theme-text-secondary line-clamp-2 max-w-md">{{ $testimoni->isi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-yellow-400">
                                    @for ($i = 0; $i < $testimoni->rating; $i++)
                                        <i class="fas fa-star text-sm"></i>
                                    @endfor
                                    @for ($i = $testimoni->rating; $i < 5; $i++)
                                        <i class="far fa-star text-sm text-gray-400"></i>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.testimoni.edit', $testimoni->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-500/10 hover:bg-blue-500/20 text-blue-500 rounded-lg transition duration-150"
                                        title="Edit">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.testimoni.destroy', $testimoni->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-lg transition duration-150"
                                            title="Hapus">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-comment-slash text-5xl theme-text-secondary mb-4 opacity-20"></i>
                                    <p class="theme-text-secondary font-medium">Belum ada testimoni</p>
                                    <p class="theme-text-secondary text-sm mt-1 opacity-70">Klik tombol "Tambah Testimoni" untuk
                                        memulai</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y theme-divide">
            @forelse($testimonis as $testimoni)
                <div class="p-4 hover:bg-blue-400/5 transition duration-150">
                    <div class="flex items-start gap-4">
                        @if ($testimoni->foto)
                            <img src="{{ Storage::url($testimoni->foto) }}" alt="{{ $testimoni->nama }}"
                                class="h-16 w-16 rounded-full object-cover ring-2 ring-blue-400/30 flex-shrink-0 theme-border border">
                        @else
                            <div
                                class="h-16 w-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-white text-xl"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold theme-text-primary truncate">{{ $testimoni->nama }}</h3>
                            <p class="text-sm theme-text-secondary mb-2">{{ $testimoni->pekerjaan ?? '-' }}</p>
                            <div class="flex items-center text-yellow-400 mb-2">
                                @for ($i = 0; $i < $testimoni->rating; $i++)
                                    <i class="fas fa-star text-xs"></i>
                                @endfor
                            </div>
                            <p class="text-sm theme-text-secondary line-clamp-2 mb-3">{{ $testimoni->isi }}</p>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.testimoni.edit', $testimoni->id) }}"
                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-500/10 hover:bg-blue-500/20 text-blue-500 rounded-lg transition text-sm font-medium">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                                <form action="{{ route('admin.testimoni.destroy', $testimoni->id) }}" method="POST"
                                    class="flex-1"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <i class="fas fa-comment-slash text-5xl theme-text-secondary mb-4 opacity-20"></i>
                    <p class="theme-text-secondary font-medium">Belum ada testimoni</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($testimonis->hasPages())
            <div class="px-6 py-4 theme-bg-secondary theme-border border-t">
                {{ $testimonis->links() }}
            </div>
        @endif
    </div>
@endsection