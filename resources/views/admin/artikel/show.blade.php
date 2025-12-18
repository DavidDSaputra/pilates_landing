@extends('layoutsadmin.app')

@section('title', 'Detail Artikel')
@section('page-title', 'Detail Artikel')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.artikels.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
            </a>
            <div class="flex space-x-2">
                <a href="{{ route('admin.artikels.edit', $artikel->id) }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('admin.artikels.destroy', $artikel->id) }}" method="POST" class="inline-block"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
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
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $artikel->judul }}</h1>

                @if($artikel->gambar_featured)
                    <div class="mb-6">
                        <img src="{{ Storage::url($artikel->gambar_featured) }}" alt="{{ $artikel->judul }}"
                            class="w-full h-auto rounded-lg shadow-md">
                    </div>
                @endif

                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($artikel->konten)) !!}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h3 class="font-medium text-gray-900 mb-4">Informasi Artikel</h3>

                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Penulis</p>
                            <p class="font-medium">{{ $artikel->penulis->nama_lengkap ?? 'Unknown' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 uppercase">Status</p>
                            @if($artikel->published_at)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Published
                                </span>
                            @endif
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 uppercase">Tanggal Publikasi</p>
                            <p class="font-medium">
                                {{ $artikel->published_at ? $artikel->published_at->format('d M Y H:i') : '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 uppercase">Dibuat Pada</p>
                            <p class="font-medium">{{ $artikel->created_at->format('d M Y H:i') }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 uppercase">Views</p>
                            <p class="font-medium">{{ $artikel->views }}</p>
                        </div>
                    </div>
                </div>

                @if($artikel->tags)
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-900 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($artikel->tags as $tag)
                                <span class="bg-amber-100 text-amber-800 text-xs px-2 py-1 rounded-full">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection