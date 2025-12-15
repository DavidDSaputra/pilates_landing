@extends('layoutsadmin.app')

@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.kategori-produks.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
            </a>
            <div class="flex space-x-2">
                <a href="{{ route('admin.kategori-produks.edit', $kategori->id) }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('admin.kategori-produks.destroy', $kategori->id) }}" method="POST"
                    class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="flex items-center mb-6">
                    @if($kategori->gambar)
                        <img src="{{ Storage::url($kategori->gambar) }}" alt="{{ $kategori->nama_kategori }}"
                            class="h-20 w-20 rounded-lg object-cover mr-4 shadow-sm">
                    @else
                        <div class="h-20 w-20 rounded-lg bg-gray-200 mr-4 flex items-center justify-center shadow-sm">
                            <i class="fas fa-box text-3xl text-gray-400"></i>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $kategori->nama_kategori }}</h1>
                        <p class="text-gray-500">Slug: {{ $kategori->slug }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="font-medium text-gray-900 mb-2">Deskripsi</h3>
                    <p class="text-gray-700">{{ $kategori->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Produk Terbaru dalam Kategori Ini</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Produk</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stok</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($kategori->produk as $produk)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $produk->nama_produk }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $produk->stok }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.produk.show', $produk->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada produk dalam kategori ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h3 class="font-medium text-gray-900 mb-4">Informasi Kategori</h3>

                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Urutan</p>
                            <p class="font-medium">{{ $kategori->urutan }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 uppercase">Jumlah Produk</p>
                            <p class="font-medium">{{ $kategori->produk->count() }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 uppercase">Dibuat Pada</p>
                            <p class="font-medium">{{ $kategori->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection