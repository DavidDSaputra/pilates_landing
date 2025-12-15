<!-- Header -->
<header class="bg-white shadow-sm z-10 border-b border-amber-200">
    <div class="flex items-center justify-between px-4 py-4 lg:px-6">
        <div class="flex items-center">
            <button id="toggleSidebar" class="text-amber-900 hover:text-amber-700 mr-4">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl lg:text-2xl font-bold text-amber-900">@yield('page-title', 'Dashboard')</h1>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profileButton" class="flex items-center text-amber-900 hover:text-amber-700 focus:outline-none">
                    <i class="fas fa-user-circle text-2xl"></i>
                </button>
                <!-- Dropdown Menu -->
                <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-amber-200 py-1 z-50">
                    <div class="px-4 py-2 border-b border-amber-100">
                        <p class="text-sm font-medium text-amber-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-amber-600">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="border-t border-amber-100 mt-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>