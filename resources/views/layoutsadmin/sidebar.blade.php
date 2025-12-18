<aside id="sidebar"
    class="fixed left-0 top-0 h-full w-64 bg-gradient-dark theme-border border-r z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <!-- Logo -->
    <div class="p-6 theme-border border-b animate-slide-in-left">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-primary rounded-lg flex items-center justify-center animate-pulse-glow">
                <i class="fas fa-crown text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-blue-400">AdminPanel</h1>
                <p class="text-xs theme-text-secondary">Dashboard v2.0</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="p-4 space-y-2 h-[calc(100vh-180px)] overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-primary text-white' : 'hover:bg-blue-400/10 theme-text-secondary hover:text-blue-400' }} transition-all duration-300 animate-slide-in-left delay-100">
            <i class="fas fa-home text-lg"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Content Header -->
        <div
            class="px-4 py-2 mt-4 text-xs font-semibold theme-text-secondary uppercase tracking-wider animate-slide-in-left delay-100">
            Konten
        </div>

        <!-- Artikel -->
        <a href="{{ route('admin.artikels.index') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.artikels.*') ? 'bg-gradient-primary text-white' : 'hover:bg-blue-400/10 theme-text-secondary hover:text-blue-400' }} transition-all duration-300 animate-slide-in-left delay-200">
            <i class="fas fa-newspaper text-lg"></i>
            <span class="font-medium">Artikel</span>
        </a>

        <!-- Testimoni -->
        <a href="{{ route('admin.testimoni.index') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.testimoni.*') ? 'bg-gradient-primary text-white' : 'hover:bg-blue-400/10 theme-text-secondary hover:text-blue-400' }} transition-all duration-300 animate-slide-in-left delay-300">
            <i class="fas fa-comment-alt text-lg"></i>
            <span class="font-medium">Testimoni</span>
        </a>



        <!-- Produk -->
        <a href="{{ route('admin.produk.index') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.produk.*') ? 'bg-gradient-primary text-white' : 'hover:bg-blue-400/10 theme-text-secondary hover:text-blue-400' }} transition-all duration-300 animate-slide-in-left delay-500">
            <i class="fas fa-box text-lg"></i>
            <span class="font-medium">Produk</span>
        </a>

        <div
            class="px-4 py-2 mt-4 text-xs font-semibold theme-text-secondary uppercase tracking-wider animate-slide-in-left delay-500">
            Pengguna
        </div>

        <!-- Users -->
        @if(auth()->user()->role === 'super_admin')
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gradient-primary text-white' : 'hover:bg-blue-400/10 theme-text-secondary hover:text-blue-400' }} transition-all duration-300 animate-slide-in-left delay-600">
                <i class="fas fa-users text-lg"></i>
                <span class="font-medium">Manajemen User</span>
            </a>
        @endif

        <!-- Activity Logs -->
        <a href="{{ route('admin.activity-logs.index') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.activity-logs.*') ? 'bg-gradient-primary text-white' : 'hover:bg-blue-400/10 theme-text-secondary hover:text-blue-400' }} transition-all duration-300 animate-slide-in-left delay-600">
            <i class="fas fa-history text-lg"></i>
            <span class="font-medium">Activity Logs</span>
        </a>

    </nav>

    <!-- Bottom Section -->
    <div class="absolute bottom-0 left-0 right-0 p-4 theme-border border-t bg-gradient-dark">
        <div class="flex items-center space-x-3 px-4 py-3">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->nama_lengkap ?? 'Admin' }}&background=60A5FA&color=fff"
                alt="Admin" class="w-10 h-10 rounded-full animate-pulse-glow">
            <div class="flex-1 overflow-hidden">
                <p class="text-sm font-medium text-blue-400 truncate">{{ auth()->user()->nama_lengkap ?? 'Admin' }}</p>
                <p class="text-xs theme-text-secondary truncate">{{ auth()->user()->email }}</p>
            </div>
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="fas fa-sign-out-alt theme-text-secondary hover:text-blue-400 cursor-pointer transition-colors bg-transparent border-0"
                    title="Logout"></button>
            </form>
        </div>
    </div>
</aside>