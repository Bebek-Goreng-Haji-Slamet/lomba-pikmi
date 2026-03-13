@props(['food'])

@php
    $totalMinutes = 24 * 60;
    $minutesLeft = max(0, now()->diffInMinutes($food->pickup_limit, false));
    $progress = min(100, max(5, ($minutesLeft / $totalMinutes) * 100));
@endphp

<article class="group overflow-hidden rounded-2xl border border-white/70 bg-white/80 shadow-xl transition duration-300 hover:-translate-y-2 hover:shadow-2xl backdrop-blur-md">
    <div class="relative h-52 overflow-hidden">
        <img src="{{ $food->image_url }}" alt="{{ $food->food_name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <span class="absolute right-3 top-3 rounded-full bg-white/90 px-3 py-1 text-xs font-bold text-slate-700 shadow">{{ $food->servings }} porsi</span>
    </div>

    <div class="space-y-4 p-5">
        <div class="flex items-start justify-between gap-3">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600">{{ $food->provider_name }}</p>
                <h3 class="line-clamp-2 text-lg font-bold text-slate-800">{{ $food->food_name }}</h3>
            </div>
            <span class="rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $food->status_badge }}">{{ $food->status }}</span>
        </div>

        <p class="line-clamp-2 text-sm text-slate-600">{{ $food->description }}</p>

        <div class="space-y-2">
            <div class="flex items-center justify-between text-xs font-medium text-slate-500">
                <span>Pickup Window</span>
                <span class="{{ $food->is_urgent ? 'text-amber-600' : 'text-emerald-600' }}">{{ $food->formatted_pickup }}</span>
            </div>
            <div class="h-2.5 w-full rounded-full bg-slate-100">
                <div class="h-2.5 rounded-full {{ $food->is_urgent ? 'bg-amber-500' : 'bg-emerald-500' }}" style="width: {{ $progress }}%"></div>
            </div>
        </div>

        <a href="{{ route('public.show', $food->slug) }}" class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
            View Detail
        </a>
    </div>
</article>