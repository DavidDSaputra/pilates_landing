@extends('layoutsadmin.app')

@section('title', 'Edit Kategori')

@section('head')
@endsection

@section('content')
    <script src="https://cdn.tiny.cloud/1/pxtqyte6btxrd0039qdxzx1frknn13n8l8nbob563irb7q96/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>
    <div class="container-fluid px-3 md:px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div class="mb-4 md:mb-0">
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                    <a href="{{ route('admin.kategori-produks.index') }}"
                        class="text-orange-600 hover:text-orange-800 transition-colors duration-200">
                        Kategori
                    </a>
                    <span>/</span>
                    <span>Edit Kategori</span>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800">Edit Kategori</h1>
                <p class="text-gray-600 text-sm md:text-base">Perbarui informasi kategori Anda</p>
            </div>
            <a href="{{ route('admin.kategori-produks.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition w-full md:w-auto justify-center mt-4 md:mt-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <!-- Storage Info Banner -->
        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="text-sm font-medium text-blue-800">Cloudinary Storage Active</h4>
                    <p class="text-xs text-blue-700 mt-1">
                        Gambar kategori akan dioptimalkan secara otomatis dan disimpan di Cloudinary untuk performa terbaik.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Main Form -->
            <div class="xl:col-span-2">
                <form action="{{ route('admin.kategori-produks.update', $kategori->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
                        <h3 class="font-medium text-gray-900 mb-4 text-lg">Informasi Dasar</h3>

                        <div class="mb-4">
                            <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori
                                *</label>
                            <input type="text" name="nama_kategori" id="nama_kategori"
                                value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required
                                class="w-full px-3 md:px-4 py-2 md:py-3 text-lg font-semibold border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                placeholder="Masukkan nama kategori...">
                            @error('nama_kategori')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Rich Text Editor Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                            <span class="text-xs text-gray-500 font-normal ml-2 hidden md:inline">
                                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Paste from Word/Google Docs - formatting preserved!
                            </span>
                        </label>

                        <textarea name="deskripsi" id="deskripsi"
                            class="tinymce-editor">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Image Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Gambar Kategori</h3>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01">
                                    </path>
                                </svg>
                                Cloudinary
                            </span>
                        </div>

                        @if($kategori->gambar)
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini:</p>
                                <img src="{{ Storage::url($kategori->gambar) }}" alt="Current Image"
                                    class="max-w-xs rounded-lg shadow-sm">
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Ganti Gambar</label>
                            <input type="file" name="gambar" id="gambar" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                            <p class="mt-1 text-xs text-gray-500">
                                Biarkan kosong jika tidak ingin mengubah. Format: JPEG, PNG, JPG, GIF, WEBP. Max: 5MB.
                            </p>
                            @error('gambar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="imagePreview" class="hidden mt-4">
                            <div class="relative">
                                <img id="previewImage" class="max-w-full h-auto rounded-lg shadow-md">
                                <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
                                    New Image Ready
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                            <a href="{{ route('admin.kategori-produks.index') }}"
                                class="px-6 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition text-center w-full md:w-auto">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition flex items-center justify-center w-full md:w-auto">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Kategori
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Settings -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan</h3>

                    <div class="mb-4">
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                        <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $kategori->urutan) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"
                            min="0">
                        <p class="mt-1 text-xs text-gray-500">Biarkan kosong untuk urutan otomatis</p>
                        @error('urutan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SEO Metadata -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">SEO & Metadata</h3>

                    <div class="mb-4">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title"
                            value="{{ old('meta_title', $kategori->meta_title) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <div class="mb-4">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta
                            Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">{{ old('meta_description', $kategori->meta_description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">Meta
                            Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords"
                            value="{{ old('meta_keywords', $kategori->meta_keywords) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                <!-- Cloudinary Benefits -->
                <div
                    class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-lg shadow-sm border border-purple-200 p-4 md:p-6">
                    <div class="flex items-center mb-3">
                        <svg class="w-6 h-6 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold text-purple-800">Cloudinary Benefits</h3>
                    </div>
                    <ul class="space-y-2 text-sm text-purple-800">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span><strong>Auto Optimization:</strong> Images optimized automatically</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span><strong>Fast Delivery:</strong> Global CDN for quick loading</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize TinyMCE
            tinymce.init({
                selector: '.tinymce-editor',
                height: 500,
                menubar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'wordcount', 'paste'
                ],
                toolbar: 'undo redo | formatselect | bold italic underline strikethrough | ' +
                    'forecolor backcolor | alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | link image media | removeformat code fullscreen',
                paste_as_text: false,
                paste_retain_style_properties: 'color font-size font-weight font-style text-decoration',
                paste_word_valid_elements: 'b,strong,i,em,h1,h2,h3,h4,h5,h6,p,ul,ol,li,a[href],span[style],div[align]',
                paste_webkit_styles: 'color font-size font-weight font-style',
                paste_merge_formats: true,
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial; font-size: 16px; line-height: 1.6; color: #374151; } ' +
                    'p { margin: 0 0 1rem 0; } ' +
                    'h1 { font-size: 2.25rem; font-weight: 700; margin: 2rem 0 1.5rem; } ' +
                    'h2 { font-size: 1.875rem; font-weight: 700; margin: 1.75rem 0 1.25rem; } ' +
                    'h3 { font-size: 1.5rem; font-weight: 700; margin: 1.5rem 0 1rem; }',
                automatic_uploads: false,
                link_default_target: '_blank',
                link_title: false,
                verify_html: false,
                mobile: {
                    theme: 'mobile',
                    plugins: ['autosave', 'lists', 'autolink'],
                    toolbar: ['undo', 'bold', 'italic', 'styleselect']
                },
                setup: function (editor) {
                    editor.on('init', function () {
                        console.log('TinyMCE initialized');
                    });
                }
            });

            // Image preview
            const featuredImageInput = document.getElementById('gambar');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');

            if (featuredImageInput) {
                featuredImageInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewImage.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    <style>
        .tox-tinymce {
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
        }

        .tox-tinymce:focus-within {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1) !important;
        }

        @media (max-width: 768px) {
            .tox-tinymce {
                height: 400px !important;
            }
        }
    </style>
@endsection