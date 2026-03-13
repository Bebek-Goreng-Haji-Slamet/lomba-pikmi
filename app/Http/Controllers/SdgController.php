<?php

namespace App\Http\Controllers;

use App\Models\FoodShare;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class SdgController extends Controller
{
    public function index(): View
    {
        $urgentRescues = collect();
        $availableFoods = collect();
        $mealsRescued = 0;

        try {
            $urgentRescues = FoodShare::query()
                ->where('status', 'Available')
                ->where('pickup_limit', '>', now())
                ->orderBy('pickup_limit')
                ->take(3)
                ->get();

            $availableFoods = FoodShare::query()
                ->where('status', 'Available')
                ->where('pickup_limit', '>', now())
                ->latest()
                ->take(12)
                ->get();

            $mealsRescued = FoodShare::query()
                ->whereIn('status', ['Booked', 'Collected'])
                ->sum('servings');
        } catch (Throwable $exception) {
            // Keep landing page available in environments where migrations are not yet applied.
        }

        return view('index', compact('urgentRescues', 'availableFoods', 'mealsRescued'));
    }

    public function inventory(): View
    {
        $user = request()->user();

        $foodShares = FoodShare::query()
            ->when($user && $user->isDonator(), function ($query) use ($user): void {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->get();

        return view('inventory', compact('foodShares'));
    }

    public function show(string $slug): View
    {
        $foodShare = FoodShare::query()->where('slug', $slug)->firstOrFail();

        return view('show', compact('foodShare'));
    }

    public function create(): View
    {
        return view('create');
    }

    public function edit(FoodShare $foodShare): View
    {
        $user = request()->user();

        if ($user && $user->isDonator() && $foodShare->user_id !== $user->id) {
            abort(403, 'Akses ditolak. Donasi ini bukan milik Anda.');
        }

        return view('create', compact('foodShare'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'food_name' => ['required', 'string', 'max:255'],
            'provider_name' => ['required', 'string', 'max:255'],
            'servings' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:Available,Booked,Collected'],
            'image_url' => ['required', 'url'],
            'pickup_limit' => ['required', 'date', 'after:now'],
            'location_detail' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        try {
            $validated['user_id'] = $request->user()?->id;
            FoodShare::create($validated);

            return redirect()->back()->with('success', 'Donasi makanan berhasil ditambahkan.');
        } catch (Throwable $exception) {
            return redirect()->back()->withInput()->withErrors([
                'store' => 'Gagal menyimpan data donasi. Silakan coba lagi.',
            ]);
        }
    }

    public function update(Request $request, FoodShare $foodShare): RedirectResponse
    {
        $user = $request->user();

        if ($user && $user->isDonator() && $foodShare->user_id !== $user->id) {
            abort(403, 'Akses ditolak. Donasi ini bukan milik Anda.');
        }

        $validated = $request->validate([
            'food_name' => ['required', 'string', 'max:255'],
            'provider_name' => ['required', 'string', 'max:255'],
            'servings' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:Available,Booked,Collected'],
            'image_url' => ['required', 'url'],
            'pickup_limit' => ['required', 'date', 'after:now'],
            'location_detail' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        try {
            $foodShare->update($validated);

            return redirect()->back()->with('success', 'Donasi makanan berhasil diperbarui.');
        } catch (Throwable $exception) {
            return redirect()->back()->withInput()->withErrors([
                'update' => 'Gagal memperbarui data donasi. Silakan coba lagi.',
            ]);
        }
    }

    public function destroy(FoodShare $foodShare): RedirectResponse
    {
        $user = request()->user();

        if ($user && $user->isDonator() && $foodShare->user_id !== $user->id) {
            abort(403, 'Akses ditolak. Donasi ini bukan milik Anda.');
        }

        $foodShare->delete();

        return redirect()->back()->with('success', 'Data donasi berhasil dihapus.');
    }
}