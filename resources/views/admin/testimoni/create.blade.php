@extends('layoutsadmin.app')

@section('title', 'Tambah Testimoni')
@section('page-title', 'Tambah Testimoni')

@section('content')
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.testimoni.index') }}"
            class="inline-flex items-center text-gray-600 hover:text-amber-700 transition duration-150">
            <i class="fas fa-arrow-left mr-2"></i>
            <span class="font-medium">Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-amber-50 to-amber-100 px-6 py-4 border-b border-amber-200">
            <h2 class="text-xl font-bold text-amber-900">Tambah Testimoni Baru</h2>
            <p class="text-sm text-amber-700 mt-1">Isi form di bawah untuk menambahkan testimoni</p>
        </div>

        <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition duration-150 @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan nama lengkap" required>
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label for="pekerjaan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Pekerjaan / Jabatan
                        </label>
                        <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition duration-150 @error('pekerjaan') border-red-500 @enderror"
                            placeholder="Contoh: CEO PT. ABC">
                        @error('pekerjaan')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Rating -->
                    <div>
                        <label for="rating" class="block text-sm font-semibold text-gray-700 mb-2">
                            Rating <span class="text-red-500">*</span>
                        </label>
                        <select name="rating" id="rating"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition duration-150 @error('rating') border-red-500 @enderror">
                            <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Bintang)</option>
                            <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Bintang)</option>
                            <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 Bintang)</option>
                            <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ (2 Bintang)</option>
                            <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ (1 Bintang)</option>
                        </select>
                        @error('rating')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Foto -->
                    <div>
                        <label for="foto" class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Profil
                        </label>
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-amber-500 transition duration-150">
                            <input type="file" name="foto" id="foto" accept="image/*" class="hidden"
                                onchange="previewImage(event)">
                            <label for="foto" class="cursor-pointer">
                                <div id="preview-container" class="hidden mb-4">
                                    <img id="image-preview"
                                        class="mx-auto h-32 w-32 rounded-full object-cover ring-4 ring-amber-200">
                                </div>
                                <div id="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600 font-medium">Klik untuk upload foto</p>
                                    <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF (Maks. 2MB)</p>
                                </div>
                            </label>
                        </div>
                        @error('foto')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Isi Testimoni -->
                    <div>
                        <label for="isi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Isi Testimoni <span class="text-red-500">*</span>
                        </label>
                        <textarea name="isi" id="isi" rows="6"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition duration-150 resize-none @error('isi') border-red-500 @enderror"
                            placeholder="Tuliskan testimoni pelanggan..." required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="submit"
                    class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-lg shadow-md transition duration-200 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Testimoni
                </button>
                <a href="{{ route('admin.testimoni.index') }}"
                    class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('upload-placeholder').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection