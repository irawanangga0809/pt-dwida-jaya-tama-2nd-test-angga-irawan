@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96 text-white">

        <h2 class="text-2xl font-semibold text-center mb-6">Login Akun</h2>

        @include('components.alerts')

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="username" class="block text-gray-400 text-sm font-semibold mb-2">Username</label>
                <input type="text" id="username" name="username" required
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none text-white">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-400 text-sm font-semibold mb-2">
                    Password 
                </label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none text-white">
            </div>

            <button type="submit"
                    class="w-full bg-indigo-500 text-white py-2 rounded-lg hover:bg-indigo-600 transition">
                Sign in
            </button> 

            <p class="mt-4 text-center text-sm text-gray-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-400 hover:underline">Daftar di sini</a>
            </p>
        </form>
    </div>
@endsection
