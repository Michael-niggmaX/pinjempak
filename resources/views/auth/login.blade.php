@extends('layouts.auth')

@section('content')
    <div class="bg-white rounded-3xl w-full max-w-md px-8 py-10 shadow-2xl border border-gray-100 relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-2 bg-custom-orange"></div>

        <div class="text-center mb-8 flex flex-col items-center">
            <div class="w-16 h-16 bg-custom-white text-white rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-orange-500/30">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <img src="{{ asset('images/pinjempak.svg') }}" alt="Logo PinjemPak" class="w-40 h-35">
                </svg>
            </div>
            
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Selamat Datang</h2>
            <p class="text-sm text-gray-500 mt-2">Masuk ke akun PinjemPak Anda</p>
        </div>

        @if (session('status'))
            <div class="bg-green-50 text-green-600 text-sm px-4 py-3 rounded-xl mb-6 text-center border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-custom-orange focus:border-custom-orange block w-full pl-11 p-3.5 transition-all"
                        placeholder="nama@pinjempak.com">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-custom-orange focus:border-custom-orange block w-full pl-11 p-3.5 transition-all"
                        placeholder="••••••••">
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full text-white bg-custom-orange hover:bg-orange-500 focus:ring-4 focus:ring-orange-200 font-semibold rounded-xl text-sm px-5 py-3.5 text-center transition-all shadow-lg shadow-orange-500/30">
                Masuk ke Sistem
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} PinjemPak - SMK N 5 Surakarta</p>
        </div>
    </div>
@endsection