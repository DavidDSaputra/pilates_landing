<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pilates Produk Sports</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Theme variables */
        :root {
            --bg-primary: #0F172A;
            --bg-secondary: #1E293B;
            --bg-card: rgba(96, 165, 250, 0.1);
            --bg-hover: rgba(96, 165, 250, 0.05);
            --text-primary: #F1F5F9;
            --text-secondary: #94A3B8;
            --border-color: rgba(96, 165, 250, 0.2);
            --shadow-color: rgba(96, 165, 250, 0.3);
        }

        [data-theme="light"] {
            --bg-primary: #F8FAFC;
            --bg-secondary: #FFFFFF;
            --bg-card: rgba(96, 165, 250, 0.05);
            --bg-hover: rgba(96, 165, 250, 0.1);
            --text-primary: #0F172A;
            --text-secondary: #475569;
            --border-color: rgba(96, 165, 250, 0.3);
            --shadow-color: rgba(96, 165, 250, 0.2);
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(96, 165, 250, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(96, 165, 250, 0.6);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.6s ease-out forwards;
        }

        .animate-slide-in-left {
            animation: slideInLeft 0.6s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out forwards;
        }

        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-rotate {
            animation: rotate 20s linear infinite;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }

        .delay-600 {
            animation-delay: 0.6s;
        }

        /* Gradient backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 100%);
        }

        .bg-gradient-dark {
            background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
            transition: background 0.3s ease;
        }

        .bg-gradient-card {
            background: var(--bg-card);
            transition: background 0.3s ease;
        }

        .theme-bg-secondary {
            background-color: var(--bg-secondary);
            transition: background-color 0.3s ease;
        }

        .theme-border {
            border-color: var(--border-color);
            transition: border-color 0.3s ease;
        }

        .theme-text-primary {
            color: var(--text-primary);
            transition: color 0.3s ease;
        }

        .theme-text-secondary {
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-primary);
        }

        ::-webkit-scrollbar-thumb {
            background: #60A5FA;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #3B82F6;
        }

        /* Theme toggle animation */
        .theme-toggle-btn {
            position: relative;
            overflow: hidden;
        }

        .theme-toggle-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(96, 165, 250, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .theme-toggle-btn:active::before {
            width: 300px;
            height: 300px;
        }

        /* Floating shapes */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            z-index: 0;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #60A5FA, #3B82F6);
            top: -150px;
            right: -150px;
            animation: float 6s ease-in-out infinite;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #3B82F6, #1E40AF);
            bottom: -100px;
            left: -100px;
            animation: float 8s ease-in-out infinite;
            animation-delay: 1s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #60A5FA, #3B82F6);
            top: 50%;
            left: 10%;
            animation: float 10s ease-in-out infinite;
            animation-delay: 2s;
        }

        /* Input focus animation */
        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px var(--shadow-color);
        }

        /* Button hover effect */
        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(96, 165, 250, 0.5);
        }

        /* Social button hover */
        .social-btn {
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px var(--shadow-color);
        }

        /* Checkbox animation */
        .checkbox-wrapper input[type="checkbox"]:checked+label::before {
            background: #60A5FA;
            border-color: #60A5FA;
        }
    </style>
</head>

<body class="font-sans min-h-screen flex items-center justify-center relative overflow-hidden"
    style="background-color: var(--bg-primary); color: var(--text-primary);">

    <!-- Floating Shapes Background -->
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>

    <!-- Theme Toggle Button (Top Right) -->
    <button id="themeToggle"
        class="theme-toggle-btn fixed top-6 right-6 p-3 theme-bg-secondary rounded-lg hover:bg-blue-400/10 transition-all duration-300 z-50 animate-fade-in-down">
        <i class="fas fa-sun text-blue-400 text-xl" id="lightIcon"></i>
        <i class="fas fa-moon text-blue-400 text-xl hidden" id="darkIcon"></i>
    </button>

    <!-- Main Container -->
    <div class="container mx-auto px-4 py-8 z-10">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-8 items-center">

                <!-- Left Side - Branding & Info -->
                <div class="hidden lg:block animate-slide-in-left">
                    <div class="text-center lg:text-left">
                        <!-- Logo -->
                        <div class="flex items-center justify-center lg:justify-start space-x-3 mb-8">
                            <div
                                class="w-16 h-16 bg-gradient-primary rounded-2xl flex items-center justify-center animate-pulse-glow">
                                <i class="fas fa-crown text-white text-3xl"></i>
                            </div>
                            <div>
                                <h1 class="text-4xl font-bold text-blue-400">Pilates Produk Sports</h1>
                                <p class="text-sm theme-text-secondary">Premium Sports Equipment</p>
                            </div>
                        </div>

                        <!-- Welcome Text -->
                        <h2 class="text-4xl font-bold theme-text-primary mb-4">Selamat Datang Admin!</h2>
                        <p class="text-lg theme-text-secondary mb-8">Masuk untuk mengelola data produk, artikel, dan
                            konten website.</p>

                        <!-- Features List -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 animate-fade-in-up delay-100">
                                <div class="w-12 h-12 bg-blue-400/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-box text-blue-400 text-xl"></i>
                                </div>
                                <div class="text-left">
                                    <h3 class="font-semibold theme-text-primary">Manajemen Produk</h3>
                                    <p class="text-sm theme-text-secondary">Kelola katalog dan stok brang</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 animate-fade-in-up delay-200">
                                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-newspaper text-blue-500 text-xl"></i>
                                </div>
                                <div class="text-left">
                                    <h3 class="font-semibold theme-text-primary">Kelola Artikel</h3>
                                    <p class="text-sm theme-text-secondary">Update konten blog dan berita</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 animate-fade-in-up delay-300">
                                <div class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-blue-600 text-xl"></i>
                                </div>
                                <div class="text-left">
                                    <h3 class="font-semibold theme-text-primary">Data User</h3>
                                    <p class="text-sm theme-text-secondary">Manajemen pengguna dan hak akses</p>
                                </div>
                            </div>
                        </div>

                        <!-- Decorative Elements -->
                        <div class="mt-12 relative">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-32 h-32 bg-blue-400/10 rounded-full animate-pulse-glow"></div>
                            </div>
                            <div class="relative flex items-center justify-center">
                                <div class="w-24 h-24 bg-gradient-primary rounded-full animate-float"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="animate-slide-in-right">
                    <div
                        class="bg-gradient-card backdrop-blur-sm theme-border border rounded-2xl p-8 sm:p-10 shadow-2xl">

                        <!-- Mobile Logo -->
                        <div class="lg:hidden flex items-center justify-center space-x-3 mb-8 animate-fade-in-down">
                            <div
                                class="w-12 h-12 bg-gradient-primary rounded-xl flex items-center justify-center animate-pulse-glow">
                                <i class="fas fa-crown text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-blue-400">Pilates</h1>
                                <p class="text-xs theme-text-secondary">Produk Sports</p>
                            </div>
                        </div>

                        <!-- Form Header -->
                        <div class="text-center mb-8 animate-fade-in-up">
                            <h2 class="text-3xl font-bold theme-text-primary mb-2">Masuk Akun</h2>
                            <p class="theme-text-secondary">Masukkan detail akun Anda untuk melanjutkan</p>
                        </div>

                        <!-- Login Form -->
                        <form id="loginForm" class="space-y-6" action="{{ route('login') }}" method="POST">
                            @csrf

                            @if($errors->any())
                                <div class="bg-red-500/10 border border-red-500/50 text-red-500 px-4 py-3 rounded-lg relative mb-4"
                                    role="alert">
                                    <strong class="font-bold">Error!</strong>
                                    <span class="block sm:inline">{{ $errors->first() }}</span>
                                </div>
                            @endif

                            <!-- Email Input -->
                            <div class="animate-fade-in-up delay-100">
                                <label class="block text-sm font-medium theme-text-primary mb-2">
                                    <i class="fas fa-envelope mr-2 text-blue-400"></i>Email Address
                                </label>
                                <input type="email" name="email" id="email" placeholder="admin@example.com"
                                    class="input-field w-full px-4 py-3 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 theme-text-primary @error('email') border-red-500 @enderror"
                                    value="{{ old('email') }}" required>
                            </div>

                            <!-- Password Input -->
                            <div class="animate-fade-in-up delay-200">
                                <label class="block text-sm font-medium theme-text-primary mb-2">
                                    <i class="fas fa-lock mr-2 text-blue-400"></i>Password
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        placeholder="Enter your password"
                                        class="input-field w-full px-4 py-3 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 theme-text-primary pr-12"
                                        required>
                                    <button type="button" id="togglePassword"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 theme-text-secondary hover:text-blue-400 transition-colors">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between animate-fade-in-up delay-300">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="remember" id="remember"
                                        class="w-4 h-4 rounded border-2 theme-border bg-transparent checked:bg-blue-400 checked:border-blue-400 transition-all cursor-pointer">
                                    <span class="text-sm theme-text-secondary">Remember me</span>
                                </label>
                                <a href="#" class="text-sm text-blue-400 hover:text-blue-300 transition-colors">
                                    Forgot Password?
                                </a>
                            </div>

                            <!-- Login Button -->
                            <button type="submit"
                                class="btn-primary w-full py-3 bg-gradient-primary text-white font-semibold rounded-lg transition-all duration-300 animate-fade-in-up delay-400 relative">
                                <span class="relative z-10 flex items-center justify-center">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Login to Dashboard
                                </span>
                            </button>

                            <!-- Divider -->
                            <div class="relative animate-fade-in-up delay-500">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t theme-border"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-4 theme-bg-secondary theme-text-secondary">Or continue with</span>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const lightIcon = document.getElementById('lightIcon');
        const darkIcon = document.getElementById('darkIcon');
        const html = document.documentElement;

        // Check for saved theme preference or default to 'dark'
        const currentTheme = localStorage.getItem('theme') || 'dark';
        html.setAttribute('data-theme', currentTheme);

        // Update icon based on current theme
        if (currentTheme === 'light') {
            lightIcon.classList.add('hidden');
            darkIcon.classList.remove('hidden');
        }

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            // Toggle icons with animation
            if (newTheme === 'light') {
                lightIcon.classList.add('hidden');
                darkIcon.classList.remove('hidden');
            } else {
                darkIcon.classList.add('hidden');
                lightIcon.classList.remove('hidden');
            }
        });

        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (togglePassword) {
            togglePassword.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle eye icon
                if (type === 'text') {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        }

        // Add floating animation to form inputs on focus
        const inputs = document.querySelectorAll('.input-field');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.classList.add('animate-pulse-glow');
            });

            input.addEventListener('blur', function () {
                this.parentElement.classList.remove('animate-pulse-glow');
            });
        });

        // Add particle effect on button hover
        const btnPrimary = document.querySelector('.btn-primary');
        if (btnPrimary) {
            btnPrimary.addEventListener('mouseenter', function () {
                this.style.boxShadow = '0 15px 30px rgba(96, 165, 250, 0.5)';
            });

            btnPrimary.addEventListener('mouseleave', function () {
                this.style.boxShadow = '';
            });
        }
    </script>

</body>

</html>