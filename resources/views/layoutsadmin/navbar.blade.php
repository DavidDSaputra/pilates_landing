<header class="bg-gradient-dark theme-border border-b sticky top-0 z-40">
    <div class="px-4 sm:px-8 py-4 flex items-center justify-between">
        <!-- Mobile Menu Button -->
        <button id="menuBtn"
            class="lg:hidden p-2 theme-bg-secondary rounded-lg hover:bg-blue-400/10 transition-all duration-300 mr-4">
            <i class="fas fa-bars text-blue-400 text-xl"></i>
        </button>

        <div class="animate-fade-in-up flex-1">
            <h2 class="text-xl sm:text-2xl font-bold text-blue-400">Dashboard Overview</h2>
            <p class="text-xs sm:text-sm theme-text-secondary hidden sm:block">Welcome back,
                {{ auth()->user()->nama_lengkap ?? 'Admin' }}! Here's what's happening today.</p>
        </div>

        <div class="flex items-center space-x-2 sm:space-x-4 animate-fade-in-up delay-200">
            <div class="relative hidden md:block">
                <input type="text" placeholder="Search..."
                    class="px-4 py-2 pl-10 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition-all theme-text-primary w-48 lg:w-64">
                <i class="fas fa-search absolute left-3 top-3 theme-text-secondary"></i>
            </div>

            <button
                class="md:hidden p-2 theme-bg-secondary rounded-lg hover:bg-blue-400/10 transition-all duration-300">
                <i class="fas fa-search text-blue-400 text-lg"></i>
            </button>

            <!-- Theme Toggle Button -->
            <button id="themeToggle"
                class="theme-toggle-btn p-2 theme-bg-secondary rounded-lg hover:bg-blue-400/10 transition-all duration-300 relative">
                <i class="fas fa-sun text-blue-400 text-lg" id="lightIcon"></i>
                <i class="fas fa-moon text-blue-400 text-lg hidden" id="darkIcon"></i>
            </button>

            <button class="relative p-2 theme-bg-secondary rounded-lg hover:bg-blue-400/10 transition-all duration-300">
                <i class="fas fa-bell text-blue-400 text-lg"></i>
                <span
                    class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full text-xs flex items-center justify-center animate-pulse text-white">3</span>
            </button>

            <button
                class="p-2 theme-bg-secondary rounded-lg hover:bg-blue-400/10 transition-all duration-300 hidden sm:block">
                <i class="fas fa-envelope text-blue-400 text-lg"></i>
            </button>
        </div>
    </div>
</header>