@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-xl">
        <div class="overflow-hidden rounded-3xl border border-white/40 bg-white/80 shadow-2xl backdrop-blur-md">
            <div class="bg-linear-to-r from-emerald-600 to-teal-600 px-8 py-7 text-white">
                <p class="text-sm font-semibold uppercase tracking-wider text-emerald-100">Welcome Back</p>
                <h1 class="mt-2 text-3xl font-extrabold">Masuk ke Akun Anda</h1>
                <p class="mt-2 text-sm text-emerald-100">Lanjutkan kontribusi Anda untuk menyelamatkan makanan.</p>
            </div>

            <div class="px-8 py-8">
                <form action="{{ route('login.attempt') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                            placeholder="nama@email.com"
                        >
                        @error('email')
                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                            placeholder="Masukkan password"
                        >
                        @error('password')
                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="inline-flex items-center gap-3 text-sm text-slate-600">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            @checked(old('remember'))
                            class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                        >
                        Ingat saya di perangkat ini
                    </label>

                    <button type="submit" class="w-full rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg transition hover:bg-emerald-700">
                        Login
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-emerald-700 hover:text-emerald-800">Daftar di sini</a>
                </p>
            </div>
        </div>
    </section>
@endsection
