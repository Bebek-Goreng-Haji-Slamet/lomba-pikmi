@extends('layouts.app')

@section('content')
    <section class="space-y-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900">
                    {{ auth()->user()?->isAdmin() ? 'Admin FoodShare Dashboard' : 'Donator Inventory' }}
                </h1>
                <p class="text-slate-600">
                    {{ auth()->user()?->isAdmin() ? 'Kelola semua donasi dan pantau pemilik data.' : 'Kelola donasi makanan yang Anda buat.' }}
                </p>
            </div>
            <a href="{{ route('contributor.create') }}" class="rounded-2xl bg-emerald-600 px-5 py-3 font-semibold text-white shadow-xl transition hover:bg-emerald-700">+ Tambah Donasi</a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-white/50 bg-white/80 shadow-xl backdrop-blur-md">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-slate-900 text-xs uppercase tracking-wide text-white">
                        <tr>
                            <th class="px-5 py-4">Food</th>
                            <th class="px-5 py-4">Provider</th>
                            <th class="px-5 py-4">Servings</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4">Pickup</th>
                            <th class="px-5 py-4">Donator</th>
                            <th class="px-5 py-4">Quick Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($foodShares as $food)
                            <tr class="hover:bg-emerald-50/40">
                                <td class="px-5 py-4">
                                    <p class="font-semibold text-slate-900">{{ $food->food_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $food->location_detail }}</p>
                                </td>
                                <td class="px-5 py-4 text-slate-700">{{ $food->provider_name }}</td>
                                <td class="px-5 py-4 font-semibold text-slate-900">{{ $food->servings }}</td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $food->status_badge }}">{{ $food->status }}</span>
                                </td>
                                <td class="px-5 py-4 text-slate-700">{{ $food->formatted_pickup }}</td>
                                <td class="px-5 py-4 text-slate-700">{{ $food->user?->name ?? 'Tidak diketahui' }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <a href="{{ route('public.show', $food->slug) }}" class="rounded-xl border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-700">View</a>
                                        <a href="{{ route('contributor.edit', $food) }}" class="rounded-xl bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white">Edit</a>

                                        <x-modal-action
                                            button-label="Delete"
                                            button-class="bg-rose-500 text-white"
                                            title="Hapus Donasi"
                                            description="Data yang dihapus tidak bisa dikembalikan. Lanjutkan?"
                                        >
                                            <form action="{{ route('contributor.destroy', $food) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-xl bg-rose-600 px-4 py-2 text-sm font-semibold text-white">Ya, Hapus</button>
                                            </form>
                                        </x-modal-action>
                                    </div>

                                    <form action="{{ route('contributor.update', $food) }}" method="POST" class="mt-2 flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="food_name" value="{{ $food->food_name }}">
                                        <input type="hidden" name="provider_name" value="{{ $food->provider_name }}">
                                        <input type="hidden" name="servings" value="{{ $food->servings }}">
                                        <input type="hidden" name="image_url" value="{{ $food->image_url }}">
                                        <input type="hidden" name="pickup_limit" value="{{ $food->pickup_limit?->format('Y-m-d\TH:i') }}">
                                        <input type="hidden" name="location_detail" value="{{ $food->location_detail }}">
                                        <input type="hidden" name="description" value="{{ $food->description }}">
                                        <select name="status" class="rounded-xl border border-slate-200 px-2 py-1 text-xs font-medium ring-emerald-300 focus:ring-2">
                                            @foreach (['Available', 'Booked', 'Collected'] as $status)
                                                <option value="{{ $status }}" @selected($food->status === $status)>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="rounded-xl bg-emerald-600 px-3 py-1.5 text-xs font-semibold text-white">Update Status</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-8 text-center text-slate-500">Belum ada data donasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection