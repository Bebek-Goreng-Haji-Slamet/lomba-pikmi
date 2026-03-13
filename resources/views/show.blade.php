@extends('layouts.app')

@section('content')
    <section class="grid gap-8 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="overflow-hidden rounded-2xl border border-white/50 bg-white/80 shadow-xl backdrop-blur-md">
                <img src="{{ $foodShare->image_url }}" alt="{{ $foodShare->food_name }}" class="h-[420px] w-full object-cover">
            </div>

            <div class="rounded-2xl border border-white/50 bg-white/80 p-7 shadow-xl backdrop-blur-md">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600">{{ $foodShare->provider_name }}</p>
                        <h1 class="mt-1 text-3xl font-extrabold text-slate-900">{{ $foodShare->food_name }}</h1>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $foodShare->status_badge }}">{{ $foodShare->status }}</span>
                </div>

                <p class="mt-6 leading-relaxed text-slate-700">{{ $foodShare->description }}</p>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-2xl border border-white/50 bg-white/80 p-6 shadow-xl backdrop-blur-md">
                <h2 class="text-xl font-bold text-slate-900">Pickup Information</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <div class="flex items-start justify-between gap-4">
                        <dt class="font-medium text-slate-500">Servings</dt>
                        <dd class="font-semibold text-slate-900">{{ $foodShare->servings }} porsi</dd>
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <dt class="font-medium text-slate-500">Pickup Limit</dt>
                        <dd class="text-right font-semibold {{ $foodShare->is_urgent ? 'text-amber-600' : 'text-emerald-700' }}">{{ $foodShare->formatted_pickup }}</dd>
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <dt class="font-medium text-slate-500">Location</dt>
                        <dd class="text-right text-slate-700">{{ $foodShare->location_detail }}</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <x-modal-action
                        button-label="Klaim Makanan"
                        button-class="w-full bg-emerald-600 text-white"
                        title="Klaim Donasi Makanan"
                        description="Simulasi klaim berhasil. Tim relawan akan menghubungi penyedia untuk proses pickup."
                    >
                        <button type="button" class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white" @click="open = false">Tutup</button>
                    </x-modal-action>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-white/50 bg-white/80 shadow-xl backdrop-blur-md">
                <div class="h-56 bg-[linear-gradient(135deg,#d1fae5_0%,#fef3c7_100%)] p-5">
                    <div class="grid h-full grid-cols-6 grid-rows-4 gap-2 opacity-80">
                        <div class="col-span-2 rounded-lg border border-white/60 bg-white/40"></div>
                        <div class="col-span-4 rounded-lg border border-white/60 bg-white/30"></div>
                        <div class="col-span-3 rounded-lg border border-white/60 bg-white/35"></div>
                        <div class="col-span-3 rounded-lg border border-white/60 bg-white/25"></div>
                        <div class="col-span-5 rounded-lg border border-white/60 bg-white/35"></div>
                        <div class="rounded-full bg-amber-400 shadow-lg"></div>
                    </div>
                </div>
                <div class="p-5">
                    <p class="text-sm font-semibold text-slate-800">Map Preview (Demo)</p>
                    <p class="mt-1 text-sm text-slate-600">{{ $foodShare->location_detail }}</p>
                </div>
            </div>
        </aside>
    </section>
@endsection