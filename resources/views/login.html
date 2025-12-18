<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CashFlow Mandiri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Firebase SDKs -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getAuth, signInWithEmailAndPassword, signInWithPopup, GoogleAuthProvider, FacebookAuthProvider } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";
    </script>
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
                                <h1 class="text-4xl font-bold text-blue-400">CashFlow Mandiri</h1>
                                <p class="text-sm theme-text-secondary">Pencatatan Keuangan Pribadi</p>
                            </div>
                        </div>

                        <!-- Welcome Text -->
                        <h2 class="text-4xl font-bold theme-text-primary mb-4">Selamat Datang!</h2>
                        <p class="text-lg theme-text-secondary mb-8">Masuk untuk mulai mencatat dan memantau arus kas
                            pribadi Anda dengan mudah.</p>

                        <!-- Features List -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 animate-fade-in-up delay-100">
                                <div class="w-12 h-12 bg-blue-400/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-wallet text-blue-400 text-xl"></i>
                                </div>
                                <div class="text-left">
                                    <h3 class="font-semibold theme-text-primary">Catat Transaksi</h3>
                                    <p class="text-sm theme-text-secondary">Rekam pemasukan dan pengeluaran harian</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 animate-fade-in-up delay-200">
                                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-chart-pie text-blue-500 text-xl"></i>
                                </div>
                                <div class="text-left">
                                    <h3 class="font-semibold theme-text-primary">Analisa Keuangan</h3>
                                    <p class="text-sm theme-text-secondary">Grafik visual kondisi keuangan Anda</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 animate-fade-in-up delay-300">
                                <div class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-bullseye text-blue-600 text-xl"></i>
                                </div>
                                <div class="text-left">
                                    <h3 class="font-semibold theme-text-primary">Atur Budget</h3>
                                    <p class="text-sm theme-text-secondary">Kelola anggaran agar lebih hemat</p>
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
                                <h1 class="text-2xl font-bold text-blue-400">CashFlow</h1>
                                <p class="text-xs theme-text-secondary">Pencatatan Pribadi</p>
                            </div>
                        </div>

                        <!-- Form Header -->
                        <div class="text-center mb-8 animate-fade-in-up">
                            <h2 class="text-3xl font-bold theme-text-primary mb-2">Masuk Akun</h2>
                            <p class="theme-text-secondary">Masukkan detail akun Anda untuk melanjutkan</p>
                        </div>

                        <!-- Login Form -->
                        <form id="loginForm" class="space-y-6">

                            <!-- Email Input -->
                            <div class="animate-fade-in-up delay-100">
                                <label class="block text-sm font-medium theme-text-primary mb-2">
                                    <i class="fas fa-envelope mr-2 text-blue-400"></i>Email Address
                                </label>
                                <input type="email" id="email" placeholder="admin@example.com"
                                    class="input-field w-full px-4 py-3 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 theme-text-primary"
                                    required>
                            </div>

                            <!-- Password Input -->
                            <div class="animate-fade-in-up delay-200">
                                <label class="block text-sm font-medium theme-text-primary mb-2">
                                    <i class="fas fa-lock mr-2 text-blue-400"></i>Password
                                </label>
                                <div class="relative">
                                    <input type="password" id="password" placeholder="Enter your password"
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
                                    <input type="checkbox" id="remember"
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

                            <!-- Social Login Buttons -->
                            <div class="grid grid-cols-2 gap-4 animate-fade-in-up delay-600">
                                <button type="button"
                                    class="social-btn py-3 theme-bg-secondary theme-border border rounded-lg hover:border-blue-400 transition-all duration-300 flex items-center justify-center space-x-2">
                                    <i class="fab fa-google text-red-500 text-xl"></i>
                                    <span class="theme-text-primary font-medium hidden sm:inline">Google</span>
                                </button>
                                <button type="button"
                                    class="social-btn py-3 theme-bg-secondary theme-border border rounded-lg hover:border-blue-400 transition-all duration-300 flex items-center justify-center space-x-2">
                                    <i class="fab fa-facebook text-blue-600 text-xl"></i>
                                    <span class="theme-text-primary font-medium hidden sm:inline">Facebook</span>
                                </button>
                            </div>

                            <!-- Sign Up Link -->
                            <p class="text-center theme-text-secondary text-sm animate-fade-in-up delay-700">
                                Don't have an account?
                                <a href="{{ route('signup') }}"
                                    class="text-blue-400 hover:text-blue-300 font-semibold transition-colors">
                                    Sign up now
                                </a>
                            </p>

                        </form>

                    </div>

                    <!-- Additional Info -->
                    <p class="text-center theme-text-secondary text-xs mt-6 animate-fade-in-up delay-800">
                        By logging in, you agree to our
                        <a href="#" class="text-blue-400 hover:text-blue-300">Terms of Service</a>
                        and
                        <a href="#" class="text-blue-400 hover:text-blue-300">Privacy Policy</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getAuth, signInWithEmailAndPassword, signInWithPopup, GoogleAuthProvider, FacebookAuthProvider } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

        // Your web app's Firebase configuration
        // REPLACE THIS WITH YOUR CONFIGURATION FROM FIREBASE CONSOLE
        const firebaseConfig = {
            apiKey: "AIzaSyAZVYNI58Fx5L5QJgguotmT9uM7xxL38i4",
            authDomain: "uas-cashflow-app.firebaseapp.com",
            projectId: "uas-cashflow-app",
            storageBucket: "uas-cashflow-app.firebasestorage.app",
            messagingSenderId: "712776728248",
            appId: "1:712776728248:web:a19dad716ce9d2d7607e4d",
            measurementId: "G-3JZ5B8LJ0Y"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

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

        async function sendTokenToBackend(user) {
            const token = await user.getIdToken();
            try {
                const response = await fetch('{{ route("auth.firebase") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id_token: token })
                });
                const data = await response.json();
                if (data.status === 'success') {
                    window.location.href = data.redirect;
                } else {
                    alert('Backend Authentication Failed: ' + data.message);
                }
            } catch (error) {
                console.error('Error sending token:', error);
                alert('System Error. Please try again.');
            }
        }

        // Form submission
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const remember = document.getElementById('remember').checked;

                // Show loading animation
                const submitBtn = loginForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Logging in...';
                submitBtn.disabled = true;

                try {
                    const userCredential = await signInWithEmailAndPassword(auth, email, password);
                    const user = userCredential.user;
                    // Success animation
                    submitBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Success! Redirecting...';
                    submitBtn.classList.add('bg-green-500');

                    await sendTokenToBackend(user);

                } catch (error) {
                    const errorCode = error.code;
                    const errorMessage = error.message;
                    alert('Login Failed: ' + errorMessage);
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }

        // Social Login
        const googleBtns = document.querySelectorAll('.fa-google');
        googleBtns.forEach(btn => {
            btn.closest('button').addEventListener('click', async () => {
                const provider = new GoogleAuthProvider();
                try {
                    const result = await signInWithPopup(auth, provider);
                    const user = result.user;
                    await sendTokenToBackend(user);
                } catch (error) {
                    console.error(error);
                    alert('Google Sign-In Failed: ' + error.message);
                }
            });
        });

        const facebookBtns = document.querySelectorAll('.fa-facebook');
        facebookBtns.forEach(btn => {
            btn.closest('button').addEventListener('click', async () => {
                const provider = new FacebookAuthProvider();
                try {
                    const result = await signInWithPopup(auth, provider);
                    const user = result.user;
                    await sendTokenToBackend(user);
                } catch (error) {
                    console.error(error);
                    alert('Facebook Sign-In Failed: ' + error.message);
                }
            });
        });


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