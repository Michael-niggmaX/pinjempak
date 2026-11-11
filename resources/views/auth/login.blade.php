@extends('layouts.auth')

@section('content')
    <div class="bg-gray-50 rounded-3xl w-full max-w-sm px-6 py-8 md:px-10 md:py-10 shadow-sm border border-gray-100">
        <h2 class="text-2xl md:text-3xl text-center mb-8 font-semibold text-gray-800">Login</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm text-center">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full bg-white rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-custom-orange focus:border-transparent transition-all">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password:</label>
                <input id="password" type="password" name="password" required
                    class="w-full bg-white rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-custom-orange focus:border-transparent transition-all">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center mt-2">
                <button type="submit" class="w-full bg-custom-orange text-white font-medium py-3 rounded-xl hover:bg-orange-500 transition-colors shadow-sm">
                    Masuk
                </button>
            </div>
        </form>
    </div>
@endsection