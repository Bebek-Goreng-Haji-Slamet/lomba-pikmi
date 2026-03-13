@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden rounded-3xl border border-white/40 bg-white/70 p-8 shadow-xl backdrop-blur-md md:p-12">
        <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-emerald-200/40 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-amber-200/40 blur-3xl"></div>

        <div class="relative grid gap-8 md:grid-cols-2 md:items-center">
            <div class="space-y-5">
                <p class="inline-flex rounded-full bg-emerald-100 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-700">SDG 2 - Zero Hunger</p>
                <h1 class="text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">End Hunger Today</h1>
                <p class="max-w-xl text-base text-slate-600 md:text-lg">Platform food rescue untuk menyalurkan makanan layak konsumsi dari restoran dan katering ke komunitas yang membutuhkan.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('contributor.create') }}" class="rounded-2xl bg-emerald-600 px-6 py-3 font-semibold text-white shadow-xl transition hover:bg-emerald-700">Donasikan Makanan</a>
                    <a href="{{ route('contributor.inventory') }}" class="rounded-2xl border border-slate-200 bg-white px-6 py-3 font-semibold text-slate-700 transition hover:border-emerald-300">Kelola Inventory</a>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-slate-900 p-5 text-white shadow-xl">
                    <p class="text-sm text-slate-300">Meals Rescued</p>
                    <p class="mt-2 text-3xl font-extrabold">{{ number_format($mealsRescued) }}</p>
                </div>
                <div class="rounded-2xl bg-amber-100 p-5 shadow-xl">
                    <p class="text-sm text-amber-700">Urgent Rescue</p>
                    <p class="mt-2 text-3xl font-extrabold text-amber-900">{{ $urgentRescues->count() }}</p>
                </div>
                <div class="rounded-2xl bg-emerald-100 p-5 shadow-xl sm:col-span-2">
                    <p class="text-sm text-emerald-700">Available Food Listings</p>
                    <p class="mt-2 text-3xl font-extrabold text-emerald-900">{{ $availableFoods->count() }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-12">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-slate-900">Urgent Rescue</h2>
            <span class="rounded-full bg-amber-100 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-amber-700">Prioritas &lt; 2 Jam</span>
        </div>

        <div class="grid gap-8 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($urgentRescues as $food)
                <x-food-card :food="$food" />
            @empty
                <p class="rounded-2xl border border-dashed border-slate-300 bg-white/70 p-6 text-slate-600">Tidak ada donasi urgent saat ini.</p>
            @endforelse
        </div>
    </section>

    <section class="mt-14">
        <h2 class="mb-6 text-2xl font-bold text-slate-900">Available Food</h2>
        <div class="grid gap-8 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($availableFoods as $food)
                <x-food-card :food="$food" />
            @empty
                <p class="rounded-2xl border border-dashed border-slate-300 bg-white/70 p-6 text-slate-600">Belum ada donasi tersedia.</p>
            @endforelse
        </div>
    </section>
@endsection