<!--Untuk Forgot Password-->

@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 bg-cover bg-center" 
     style="background-image: url('{{ asset('images/loginbackground.jpg') }}')">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-blue-700">Lupa Password</h2>

        <p class="mb-4 text-sm text-gray-600">
            Tidak masalah. Masukkan email kamu dan kami akan kirimkan tautan untuk mereset password.
        </p>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm bg-green-50 border border-green-300 rounded p-3">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm bg-red-50 border border-red-300 rounded p-3">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full px-4 py-3 mb-6 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition duration-200 font-semibold">
                Kirim Link Reset Password
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            Sudah ingat password? <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Login di sini</a>
        </p>
    </div>
</div>
@endsection
