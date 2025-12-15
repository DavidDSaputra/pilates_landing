@extends('layoutsadmin.app')

@section('title', 'Edit Article')

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
                    <a href="{{ route('admin.artikels.index') }}"
                        class="text-orange-600 hover:text-orange-800 transition-colors duration-200">
                        Articles
                    </a>
                    <span>/</span>
                    <span>Edit Article</span>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800">Edit Article</h1>
                <p class="text-gray-600 text-sm md:text-base">Update your content</p>
            </div>
            <a href="{{ route('admin.artikels.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition w-full md:w-auto justify-center mt-4 md:mt-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to List
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
                        Featured images will be automatically uploaded to Cloudinary for optimal performance and fast
                        delivery.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Main Form -->
            <div class="xl:col-span-2">
                <form action="{{ route('admin.artikels.update', $artikel->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $artikel->judul) }}" required
                            class="w-full px-3 md:px-4 py-2 md:py-3 text-lg md:text-2xl font-semibold border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                            placeholder="Enter your article title here...">
                        @error('judul')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rich Text Editor Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
                        <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">
                            Content *
                            <span class="text-xs text-gray-500 font-normal ml-2 hidden md:inline">
                                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Paste from Word/Google Docs - formatting preserved!
                            </span>
                        </label>

                        <textarea name="konten" id="konten"
                            class="tinymce-editor">{{ old('konten', $artikel->konten) }}</textarea>

                        @error('konten')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Image Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Featured Image</h3>
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

                        @if($artikel->gambar_featured)
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-700 mb-2">Current Image:</p>
                                <img src="{{ Storage::url($artikel->gambar_featured) }}" alt="Current Featured Image"
                                    class="max-w-xs rounded-lg shadow-sm">
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="gambar_featured" class="block text-sm font-medium text-gray-700 mb-2">Change
                                Image</label>
                            <input type="file" name="gambar_featured" id="gambar_featured" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                            <p class="mt-1 text-xs text-gray-500">
                                Leave empty to keep current image. Supported formats: JPEG, PNG, JPG, GIF, SVG, WEBP. Max
                                size: 5MB.
                            </p>
                            @error('gambar_featured')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="imagePreview" class="hidden mt-4">
                            <div class="relative">
                                <img id="previewImage" class="max-w-full h-auto rounded-lg shadow-md">
                                <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
                                    border-radius: 0.375rem !important;
                                    }

                                    /* Focus state */
                                    .tox-tinymce:focus-within {
                                    border-color: #f97316 !important;
                                    box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1) !important;
                                    }

                                    /* Responsive adjustments for mobile */
                                    @media (max-width: 768px) {
                                    .tox-tinymce {
                                    height: 400px !important;
                                    }
                                    }
                                    </style>
@endsection