@extends('layouts.main')

@section('content')
    <div class="mt-2 md:mt-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <h1 class="text-2xl md:text-3xl font-semibold text-gray-800">Kelola User</h1>
            <a href="{{ route('users.create') }}" class="bg-custom-orange text-white px-6 py-2.5 rounded-full font-medium hover:bg-orange-500 transition-colors shadow-sm w-full md:w-auto text-center">
                + Tambah User
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6 shadow-sm" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6 shadow-sm" role="alert">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <div class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 font-semibold text-gray-600 text-sm">Nama</th>
                        <th class="p-4 font-semibold text-gray-600 text-sm">Email</th>
                        <th class="p-4 font-semibold text-gray-600 text-sm">Role</th>
                        <th class="p-4 font-semibold text-gray-600 text-sm text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                        <td class="p-4 font-medium text-gray-800">{{ $user->name }}</td>
                        <td class="p-4 text-gray-600">{{ $user->email }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                {{ $user->role === 'petugas' ? 'bg-purple-100 text-purple-700' : ($user->role === 'guru' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">Belum ada user lain.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden flex flex-col gap-4">
            @forelse($users as $user)
            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-semibold text-gray-800 text-lg">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                        {{ $user->role === 'petugas' ? 'bg-purple-100 text-purple-700' : ($user->role === 'guru' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                
                <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus User
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl p-8 text-center text-gray-500 shadow-sm border border-gray-100">
                Belum ada user lain.
            </div>
            @endforelse
        </div>

    </div>
@endsection