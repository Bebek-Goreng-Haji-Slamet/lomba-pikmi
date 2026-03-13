@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-xl">
        <div class="overflow-hidden rounded-3xl border border-white/40 bg-white/80 shadow-2xl backdrop-blur-md">
            <div class="bg-linear-to-r from-amber-500 to-emerald-600 px-8 py-7 text-white">
                <p class="text-sm font-semibold uppercase tracking-wider text-amber-100">Join ShareMeal</p>
                <h1 class="mt-2 text-3xl font-extrabold">Buat Akun Baru</h1>
                <p class="mt-2 text-sm text-amber-100">Mulai berbagi makanan layak konsumsi untuk komunitas sekitar.</p>
            </div>

            <div class="px-8 py-8">
                <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Nama</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                            placeholder="Nama lengkap"
                        >
                        @error('name')
                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
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
                            placeholder="Minimal 8 karakter"
                        >
                        @error('password')
                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                            placeholder="Ulangi password"
                        >
                    </div>

                    <button type="submit" class="w-full rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg transition hover:bg-emerald-700">
                        Buat Akun
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-emerald-700 hover:text-emerald-800">Login sekarang</a>
                </p>
            </div>
        </div>
    </section>
@endsection
