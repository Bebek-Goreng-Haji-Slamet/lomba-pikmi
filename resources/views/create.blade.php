@extends('layouts.app')

@section('content')
    @php
        $isEdit = isset($foodShare);
    @endphp

    <section class="mx-auto max-w-3xl rounded-2xl border border-white/50 bg-white/80 p-8 shadow-xl backdrop-blur-md">
        <h1 class="text-3xl font-extrabold text-slate-900">{{ $isEdit ? 'Edit Donasi' : 'Tambah Donasi Makanan' }}</h1>
        <p class="mt-1 text-slate-600">Isi data makanan layak konsumsi untuk mendukung gerakan zero hunger.</p>

        @if ($errors->any())
            <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ $isEdit ? route('contributor.update', $foodShare) : route('contributor.store') }}" class="mt-8 grid gap-8">
            @csrf
            @if ($isEdit)
                @method('PUT')
            @endif

            <div class="grid gap-6 md:grid-cols-2">
                <label class="group relative block">
                    <input type="text" name="food_name" required value="{{ old('food_name', $foodShare->food_name ?? '') }}" placeholder=" " class="peer w-full rounded-2xl border border-slate-200 bg-white px-4 pb-3 pt-6 text-sm text-slate-800 shadow-sm ring-emerald-300 transition focus:border-emerald-300 focus:outline-none focus:ring-4">
                    <span class="pointer-events-none absolute left-4 top-2 text-xs font-medium text-slate-500 transition peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Food Name</span>
                </label>

                <label class="group relative block">
                    <input type="text" name="provider_name" required value="{{ old('provider_name', $foodShare->provider_name ?? '') }}" placeholder=" " class="peer w-full rounded-2xl border border-slate-200 bg-white px-4 pb-3 pt-6 text-sm text-slate-800 shadow-sm ring-emerald-300 transition focus:border-emerald-300 focus:outline-none focus:ring-4">
                    <span class="pointer-events-none absolute left-4 top-2 text-xs font-medium text-slate-500 transition peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Provider Name</span>
                </label>

                <label class="group relative block">
                    <input type="number" name="servings" min="1" required value="{{ old('servings', $foodShare->servings ?? '') }}" placeholder=" " class="peer w-full rounded-2xl border border-slate-200 bg-white px-4 pb-3 pt-6 text-sm text-slate-800 shadow-sm ring-emerald-300 transition focus:border-emerald-300 focus:outline-none focus:ring-4">
                    <span class="pointer-events-none absolute left-4 top-2 text-xs font-medium text-slate-500 transition peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Servings</span>
                </label>

                <label class="group relative block">
                    <select name="status" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-4 text-sm text-slate-800 shadow-sm ring-emerald-300 transition focus:border-emerald-300 focus:outline-none focus:ring-4">
                        @foreach (['Available', 'Booked', 'Collected'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $foodShare->status ?? 'Available') === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="group relative block md:col-span-2">
                    <input type="url" name="image_url" required value="{{ old('image_url', $foodShare->image_url ?? '') }}" placeholder=" " class="peer w-full rounded-2xl border border-slate-200 bg-white px-4 pb-3 pt-6 text-sm text-slate-800 shadow-sm ring-emerald-300 transition focus:border-emerald-300 focus:outline-none focus:ring-4">
                    <span class="pointer-events-none absolute left-4 top-2 text-xs font-medium text-slate-500 transition peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Image URL</span>
                </label>

                <label class="group relative block">
                    <input type="datetime-local" name="pickup_limit" required value="{{ old('pickup_limit', isset($foodShare) ? $foodShare->pickup_limit?->format('Y-m-d\TH:i') : '') }}" placeholder=" " class="peer w-full rounded-2xl border border-slate-200 bg-white px-4 pb-3 pt-6 text-sm text-slate-800 shadow-sm ring-emerald-300 transition focus:border-emerald-300 focus:outline-none focus:ring-4">
                    <span class="pointer-events-none absolute left-4 top-2 text-xs font-medium text-slate-500 transition peer-focus:top-2 peer-focus:text-xs">Pickup Limit</span>
                </label>

                <label class="group relative block">
                    <input type="text" name="location_detail" required value="{{ old('location_detail', $foodShare->location_detail ?? '') }}" placeholder=" " class="peer w-full rounded-2xl border border-slate-200 bg-white px-4 pb-3 pt-6 text-sm text-slate-800 shadow-sm ring-emerald-300 transition focus:border-emerald-300 focus:outline-none focus:ring-4">
                    <span class="pointer-events-none absolute left-4 top-2 text-xs font-medium text-slate-500 transition peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Location Detail</span>
                </label>
            </div>

            <label class="group relative block">
                <textarea name="description" rows="5" required placeholder=" " class="peer w-full rounded-2xl border border-slate-200 bg-white px-4 pb-3 pt-6 text-sm text-slate-800 shadow-sm ring-emerald-300 transition focus:border-emerald-300 focus:outline-none focus:ring-4">{{ old('description', $foodShare->description ?? '') }}</textarea>
                <span class="pointer-events-none absolute left-4 top-2 text-xs font-medium text-slate-500 transition peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Description</span>
            </label>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="rounded-2xl bg-emerald-600 px-6 py-3 font-semibold text-white shadow-xl transition hover:bg-emerald-700">
                    {{ $isEdit ? 'Update Donation' : 'Save Donation' }}
                </button>
                <a href="{{ route('contributor.inventory') }}" class="rounded-2xl border border-slate-200 bg-white px-6 py-3 font-semibold text-slate-700">Back to Inventory</a>
            </div>
        </form>
    </section>
@endsection