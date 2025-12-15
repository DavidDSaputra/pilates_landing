@extends('layoutsadmin.app')

@section('title', 'Manajemen Testimoni')
@section('page-title', 'Manajemen Testimoni')

@section('content')
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Testimoni</h2>
                <p class="text-sm text-gray-600 mt-1">Kelola testimoni pelanggan</p>
            </div>
            <a href="{{ route('admin.testimoni.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg shadow-sm transition duration-200 ease-in-out transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Testimoni</span>
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm animate-fade-in">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-amber-50 to-amber-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Foto
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Nama
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Pekerjaan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Testimoni
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Rating
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($testimonis as $testimoni)
                        <tr class="hover:bg-amber-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($testimoni->foto)
                                    <img src="{{ Storage::url($testimoni->foto) }}" alt="{{ $testimoni->nama }}"
                                        class="h-12 w-12 rounded-full object-cover ring-2 ring-amber-200">
                                @else
                                    <div
                                        class="h-12 w-12 rounded-full bg-gradient-to-br from-amber-200 to-amber-300 flex items-center justify-center">
                                        <i class="fas fa-user text-amber-700"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $testimoni->nama }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600">{{ $testimoni->pekerjaan ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-700 line-clamp-2 max-w-md">{{ $testimoni->isi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-yellow-400">
                                    @for ($i = 0; $i < $testimoni->rating; $i++)
                                        <i class="fas fa-star text-sm"></i>
                                    @endfor
                                    @for ($i = $testimoni->rating; $i < 5; $i++)
                                        <i class="far fa-star text-sm text-gray-300"></i>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.testimoni.edit', $testimoni->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition duration-150"
                                        title="Edit">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.testimoni.destroy', $testimoni->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition duration-150"
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
                                    <i class="fas fa-comment-slash text-5xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500 font-medium">Belum ada testimoni</p>
                                    <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Testimoni" untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-gray-200">
            @forelse($testimonis as $testimoni)
                <div class="p-4 hover:bg-amber-50 transition duration-150">
                    <div class="flex items-start gap-4">
                        @if ($testimoni->foto)
                            <img src="{{ Storage::url($testimoni->foto) }}" alt="{{ $testimoni->nama }}"
                                class="h-16 w-16 rounded-full object-cover ring-2 ring-amber-200 flex-shrink-0">
                        @else
                            <div
                                class="h-16 w-16 rounded-full bg-gradient-to-br from-amber-200 to-amber-300 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-amber-700 text-xl"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-gray-900 truncate">{{ $testimoni->nama }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $testimoni->pekerjaan ?? '-' }}</p>
                            <div class="flex items-center text-yellow-400 mb-2">
                                @for ($i = 0; $i < $testimoni->rating; $i++)
                                    <i class="fas fa-star text-xs"></i>
                                @endfor
                            </div>
                            <p class="text-sm text-gray-700 line-clamp-2 mb-3">{{ $testimoni->isi }}</p>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.testimoni.edit', $testimoni->id) }}"
                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition text-sm font-medium">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                                <form action="{{ route('admin.testimoni.destroy', $testimoni->id) }}" method="POST"
                                    class="flex-1"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <i class="fas fa-comment-slash text-5xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 font-medium">Belum ada testimoni</p>
                    <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Testimoni" untuk memulai</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($testimonis->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $testimonis->links() }}
            </div>
        @endif
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
@endsection