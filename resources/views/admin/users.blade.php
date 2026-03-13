@extends('layouts.app')

@section('content')
    <section class="space-y-6">
        <div class="rounded-3xl border border-white/40 bg-white/75 p-8 shadow-xl backdrop-blur-md">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="inline-flex rounded-full bg-slate-100 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700">Admin Panel</p>
                    <h1 class="mt-3 text-3xl font-extrabold text-slate-900">User Management</h1>
                    <p class="mt-2 text-sm text-slate-600">Kelola role akun donator dan admin untuk menjaga akses platform tetap aman.</p>
                </div>
                <div class="rounded-2xl bg-emerald-100 px-4 py-3 text-sm font-semibold text-emerald-800">
                    Total User: {{ $users->count() }}
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold">Terjadi kesalahan:</p>
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-white/40 bg-white/80 shadow-xl backdrop-blur-md">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-emerald-50/40">
                                <td class="px-6 py-4 text-sm font-medium text-slate-800">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $user->isAdmin() ? 'bg-slate-800 text-white' : 'bg-emerald-100 text-emerald-800' }}">
                                        {{ strtoupper($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <form action="{{ route('admin.users.role', $user) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                                                <option value="donator" @selected($user->role === 'donator')>Donator</option>
                                                <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                            </select>
                                            <button type="submit" class="rounded-xl bg-emerald-600 px-3 py-2 text-xs font-bold uppercase tracking-wide text-white transition hover:bg-emerald-700">Update</button>
                                        </form>

                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold uppercase tracking-wide text-red-600 transition hover:bg-red-100">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-500">Belum ada data user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
