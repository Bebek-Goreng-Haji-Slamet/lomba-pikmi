@props([
    'buttonLabel' => 'Open Modal',
    'title' => 'Confirmation',
    'description' => 'Are you sure you want to continue?',
    'buttonClass' => 'bg-emerald-600 text-white',
])

<div x-data="{ open: false }" class="inline-block">
    <button @click="open = true" type="button" class="rounded-xl px-4 py-2 text-sm font-semibold shadow transition hover:opacity-90 {{ $buttonClass }}">
        {{ $buttonLabel }}
    </button>

    <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4" style="display: none;">
        <div @click.outside="open = false" class="w-full max-w-md rounded-2xl border border-white/30 bg-white p-6 shadow-xl backdrop-blur-md">
            <h3 class="text-xl font-bold text-slate-800">{{ $title }}</h3>
            <p class="mt-2 text-sm text-slate-600">{{ $description }}</p>

            <div class="mt-6 flex items-center justify-end gap-3">
                <button type="button" @click="open = false" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700">Cancel</button>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>