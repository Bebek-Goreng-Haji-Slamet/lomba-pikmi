<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function users(): View
    {
        $users = User::query()->latest()->get();

        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => ['required', 'in:admin,donator'],
        ]);

        if ($request->user()?->is($user) && $validated['role'] !== 'admin') {
            return back()->withErrors([
                'role' => 'Akun admin yang sedang login tidak bisa diturunkan rolenya.',
            ]);
        }

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'Role user berhasil diperbarui.');
    }

    public function destroyUser(Request $request, User $user): RedirectResponse
    {
        if ($request->user()?->is($user)) {
            return back()->withErrors([
                'user' => 'Akun sendiri tidak bisa dihapus.',
            ]);
        }

        $user->delete();

        return back()->with('success', 'Akun user berhasil dihapus.');
    }
}