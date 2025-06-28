<!--Bagian dari login-->

@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 bg-cover bg-center" 
     style="background-image: url('{{ asset('images/loginbackground.jpg') }}')">

    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-blue-700">Login ke Athletix</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm bg-red-50 border border-red-300 rounded p-3">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

            <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

            <div class="flex items-center justify-between mb-6">
                <label class="inline-flex items-center text-gray-700">
                    <input type="checkbox" name="remember" class="form-checkbox text-blue-600">
                    <span class="ml-2 select-none">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition duration-200 font-semibold">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection
