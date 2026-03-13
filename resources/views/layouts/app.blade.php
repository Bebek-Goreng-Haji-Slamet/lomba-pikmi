<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareMeal - Zero Hunger Initiative</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Geist', 'ui-sans-serif', 'system-ui'],
                    },
                },
            },
        };
    </script>
</head>
<body class="min-h-screen bg-linear-to-br from-emerald-50 via-white to-amber-50 text-slate-800">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.16),transparent_42%),radial-gradient(circle_at_bottom_left,rgba(245,158,11,0.14),transparent_36%)]"></div>

    <div x-data="{ mobileMenu: false }" class="relative">
        <header class="sticky top-0 z-40 border-b border-white/40 bg-white/50 backdrop-blur-md">
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
                <a href="{{ route('public.home') }}" class="text-xl font-extrabold tracking-tight text-emerald-700">ShareMeal</a>

                <div class="hidden items-center gap-8 md:flex">
                    <a href="{{ route('public.home') }}" class="font-medium text-slate-700 transition hover:text-emerald-600">Home</a>

                    @auth
                        <a href="{{ route('contributor.inventory') }}" class="font-medium text-slate-700 transition hover:text-emerald-600">Inventory</a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.users') }}" class="font-medium text-slate-700 transition hover:text-emerald-600">User Management</a>
                        @endif
                        <a href="{{ route('contributor.create') }}" class="rounded-2xl bg-emerald-600 px-4 py-2 font-semibold text-white shadow-xl transition hover:bg-emerald-700">Share Food</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-2xl border border-slate-200 bg-white px-4 py-2 font-semibold text-slate-700 transition hover:border-slate-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="font-medium text-slate-700 transition hover:text-emerald-600">Login</a>
                        <a href="{{ route('register') }}" class="rounded-2xl bg-emerald-600 px-4 py-2 font-semibold text-white shadow-xl transition hover:bg-emerald-700">Register</a>
                    @endauth
                </div>

                <button @click="mobileMenu = !mobileMenu" class="rounded-xl border border-slate-200 bg-white p-2 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </nav>

            <div x-show="mobileMenu" x-transition class="border-t border-white/40 bg-white/80 px-6 py-4 backdrop-blur-md md:hidden">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('public.home') }}" class="rounded-xl px-3 py-2 font-medium hover:bg-emerald-50">Home</a>
                    @auth
                        <a href="{{ route('contributor.inventory') }}" class="rounded-xl px-3 py-2 font-medium hover:bg-emerald-50">Inventory</a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.users') }}" class="rounded-xl px-3 py-2 font-medium hover:bg-emerald-50">User Management</a>
                        @endif
                        <a href="{{ route('contributor.create') }}" class="rounded-xl bg-emerald-600 px-3 py-2 font-semibold text-white">Share Food</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-left font-medium text-slate-700">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-xl px-3 py-2 font-medium hover:bg-emerald-50">Login</a>
                        <a href="{{ route('register') }}" class="rounded-xl bg-emerald-600 px-3 py-2 font-semibold text-white">Register</a>
                    @endauth
                </div>
            </div>
        </header>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition class="fixed right-5 top-24 z-50 max-w-sm rounded-2xl border border-emerald-200 bg-emerald-50 p-4 shadow-xl">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="font-semibold text-emerald-800">Success</p>
                        <p class="text-sm text-emerald-700">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-emerald-700">x</button>
                </div>
            </div>
        @endif

        <main class="mx-auto max-w-7xl px-6 py-10 lg:px-8">
            @yield('content')
        </main>

        <footer class="mt-8 border-t border-white/40 bg-white/50 backdrop-blur-md">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-8 text-sm text-slate-600 md:flex-row md:items-center md:justify-between lg:px-8">
                <p>ShareMeal © {{ now()->year }} - SDG 2 Zero Hunger Initiative</p>
                <p class="font-medium text-emerald-700">Rescue food. Feed communities.</p>
            </div>
        </footer>
    </div>
</body>
</html>