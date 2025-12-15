@extends('layoutsadmin.app')

@section('title', 'Detail Pengguna')
@section('page-title', 'Detail Pengguna')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
            </a>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="flex items-center mb-8">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->nama_lengkap }}" class="h-24 w-24 rounded-full object-cover mr-6 border-4 border-amber-100">
                    @else
                        <div class="h-24 w-24 rounded-full bg-gray-200 mr-6 flex items-center justify-center border-4 border-amber-100">
                            <i class="fas fa-user text-4xl text-gray-400"></i>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->nama_lengkap }}</h1>
                        <p class="text-gray-500">{{ $user->email }}</p>
                        <div class="mt-2">
                            @if($user->role == 'admin')
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    Administrator
                                </span>
                            @elseif($user->role == 'penulis')
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Penulis
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    User
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="font-medium text-gray-900 mb-4 border-b pb-2">Informasi Kontak</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase mb-1">Email</p>
                            <p class="font-medium text-gray-900">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase mb-1">No. Telepon</p>
                            <p class="font-medium text-gray-900">{{ $user->no_telepon ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h3 class="font-medium text-gray-900 mb-4">Statistik</h3>
                    
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Bergabung Sejak</p>
                            <p class="font-medium">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                        
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Terakhir Login</p>
                            <p class="font-medium">{{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->diffForHumans() : 'Belum pernah login' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
