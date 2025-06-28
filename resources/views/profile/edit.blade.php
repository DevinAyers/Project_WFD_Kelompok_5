<!--Buat Edit Profil-->

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/editprofil.jpg')"> <!--Buat Background Gambar-->

    <div class="h-20"></div> <!-- Spacer -->

    <div class="max-w-7xl mx-auto px-4">

    <!-- Tombol Kembali -->
        <div class="mb-4">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                ← Kembali
            </a>
        </div>
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Foto Profil --}}
        <div class="flex flex-col items-center mb-6">
            <img id="preview-image"
                src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                alt="Foto Profil"
                class="h-32 w-32 rounded-full object-cover border shadow-md">

            <label for="profile_image" class="mt-2 text-sm text-blue-600 cursor-pointer hover:underline">
                Ubah Foto Profil
            </label>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
              class="bg-white shadow-lg rounded-lg p-6 space-y-5 border">
            @csrf
            @method('PATCH')

            {{-- Upload Gambar (hidden file input) --}}
            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="hidden"
                   onchange="previewImage(event)">

            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password Baru</label>
                <input type="password" name="password"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       placeholder="Kosongkan jika tidak ingin mengganti">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- <div class="h-15"></div> -->
            <div class="text-right">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 transition text-white px-5 py-2 rounded-md font-semibold">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- Script Preview Gambar --}}
    <script>
        function previewImage(event) {
            const image = document.getElementById('preview-image');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
