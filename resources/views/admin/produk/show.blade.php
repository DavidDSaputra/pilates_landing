@extends('layoutsadmin.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <h1 class="text-2xl font-bold text-gray-800">Detail Produk</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.produk.edit', $produk->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
                <a href="{{ route('admin.produk.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Images Column -->
            <div class="lg:col-span-1 space-y-4">
                <!-- Main Image -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Gambar Utama</h3>
                    @if($produk->gambar_utama)
                        <img src="{{ asset('storage/' . $produk->gambar_utama) }}" alt="{{ $produk->nama_produk }}"
                            class="w-full h-64 object-cover rounded-lg border border-gray-200">
                    @else
                        <div class="w-full h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                            <p class="text-gray-400">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>

                <!-- OG Image -->
                @if($produk->og_image)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">OG Image</h3>
                        <img src="{{ asset('storage/' . $produk->og_image) }}" alt="OG Image"
                            class="w-full h-48 object-cover rounded-lg border border-gray-200">
                    </div>
                @endif
            </div>

            <!-- Details Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Produk</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Produk</p>
                            <p class="text-base font-medium text-gray-800">{{ $produk->nama_produk }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Slug</p>
                            <p class="text-base font-medium text-gray-800">{{ $produk->slug }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <p class="text-base font-medium text-gray-800">{{ $produk->kategori->nama_kategori ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dibuat</p>
                            <p class="text-base font-medium text-gray-800">{{ $produk->created_at->format('d M Y H:i') }}
                            </p>
                        </div>
                    </div>

                    @if($produk->deskripsi_lengkap)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500 mb-2">Deskripsi</p>
                            <p class="text-base text-gray-700 whitespace-pre-line">{{ $produk->deskripsi_lengkap }}</p>
                        </div>
                    @endif
                </div>

                <!-- Gallery -->
                @if($produk->gambar->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Galeri Produk ({{ $produk->gambar->count() }}
                            gambar)</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($produk->gambar as $gambar)
                                <a href="{{ asset('storage/' . $gambar->nama_file) }}" target="_blank" class="group">
                                    <img src="{{ asset('storage/' . $gambar->nama_file) }}" alt="Gallery Image"
                                        class="w-full h-32 object-cover rounded-lg border border-gray-200 group-hover:opacity-75 transition-opacity">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- SEO Info -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">SEO & Meta Tags</h3>
                    <div class="space-y-3">
                        @if($produk->meta_title)
                            <div>
                                <p class="text-sm text-gray-500">Meta Title</p>
                                <p class="text-base text-gray-800">{{ $produk->meta_title }}</p>
                            </div>
                        @endif

                        @if($produk->meta_description)
                            <div>
                                <p class="text-sm text-gray-500">Meta Description</p>
                                <p class="text-base text-gray-800">{{ $produk->meta_description }}</p>
                            </div>
                        @endif

                        @if($produk->meta_keywords)
                            <div>
                                <p class="text-sm text-gray-500">Meta Keywords</p>
                                <p class="text-base text-gray-800">{{ $produk->meta_keywords }}</p>
                            </div>
                        @endif

                        @if($produk->canonical_url)
                            <div>
                                <p class="text-sm text-gray-500">Canonical URL</p>
                                <a href="{{ $produk->canonical_url }}" target="_blank"
                                    class="text-base text-amber-600 hover:text-amber-700">
                                    {{ $produk->canonical_url }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection