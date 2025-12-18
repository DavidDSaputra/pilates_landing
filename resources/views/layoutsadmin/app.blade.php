<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
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

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
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
                transform: translateY(-10px);
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

        .animate-slide-in-left {
            animation: slideInLeft 0.5s ease-out forwards;
        }

        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(96, 165, 250, 0.3), transparent);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(96, 165, 250, 0.4);
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
    </style>
    @stack('styles')
</head>

<body class="font-sans" style="background-color: var(--bg-primary); color: var(--text-primary);">

    <!-- Mobile Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden"></div>

    @include('layoutsadmin.sidebar')

    <!-- Main Content -->
    <main class="lg:ml-64 min-h-screen transition-all duration-300">

        @include('layoutsadmin.navbar')

        <!-- Content Area -->
        <div class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </div>

    </main>

    @include('layoutsadmin.footer')
    @stack('scripts')
</body>

</html>