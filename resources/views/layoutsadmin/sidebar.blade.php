<!-- Sidebar -->
<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-amber-50 text-amber-900 border-r border-amber-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-6 bg-amber-100 border-b border-amber-200">
        <div class="flex items-center">
            <span class="text-xl font-bold text-amber-900">Admin Panel</span>
        </div>
        <button id="closeSidebar" class="lg:hidden text-amber-900 hover:text-amber-700">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="mt-6 px-3">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-4 py-3 mb-2 {{ request()->routeIs('admin.dashboard') ? 'bg-amber-200 text-amber-900' : 'text-amber-800 hover:bg-amber-100' }} rounded-lg font-medium transition">
            <i class="fas fa-home w-5"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        @if(auth()->user()->role === 'super_admin')
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center px-4 py-3 mb-2 {{ request()->routeIs('admin.users.*') ? 'bg-amber-200 text-amber-900' : 'text-amber-800 hover:bg-amber-100' }} rounded-lg font-medium transition">
                <i class="fas fa-users w-5"></i>
                <span class="ml-3">Manajemen User</span>
            </a>
        @endif

        <a href="{{ route('admin.activity-logs.index') }}"
            class="flex items-center px-4 py-3 mb-2 {{ request()->routeIs('admin.activity-logs.*') ? 'bg-amber-200 text-amber-900' : 'text-amber-800 hover:bg-amber-100' }} rounded-lg font-medium transition">
            <i class="fas fa-history w-5"></i>
            <span class="ml-3">Activity Logs</span>
        </a>
    </nav>

    <!-- User Info -->
    <div class="absolute bottom-0 w-64 p-4 bg-amber-100 border-t border-amber-200">
        <div class="flex items-center">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=d97706&color=fff"
                alt="{{ auth()->user()->name ?? 'Admin' }}" class="w-10 h-10 rounded-full">
            <div class="ml-3">
                <p class="text-sm font-medium text-amber-900">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-amber-700">{{ auth()->user()->email ?? '' }}</p>
            </div>
        </div>
    </div>
</aside>