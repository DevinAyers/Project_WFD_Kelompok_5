<!--Bagian Halaman Edit Kelola User-->

@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit User</h1>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="max-w-md">
    @csrf
    @method('PUT')

    <label class="block mb-2 font-semibold">Nama</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2 mb-4" />
    @error('name')<p class="text-red-600 mb-4">{{ $message }}</p>@enderror

    <label class="block mb-2 font-semibold">Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2 mb-4" />
    @error('email')<p class="text-red-600 mb-4">{{ $message }}</p>@enderror

    <label class="block mb-2 font-semibold">Role</label>
    <select name="role_id" class="w-full border rounded px-3 py-2 mb-4">
        <option value="">-- Pilih Role --</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
        @endforeach
    </select>
    @error('role_id')<p class="text-red-600 mb-4">{{ $message }}</p>@enderror

    <label class="block mb-2 font-semibold">Password (biarkan kosong jika tidak ingin mengubah)</label>
    <input type="password" name="password" class="w-full border rounded px-3 py-2 mb-4" />
    @error('password')<p class="text-red-600 mb-4">{{ $message }}</p>@enderror

    <label class="block mb-2 font-semibold">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2 mb-4" />

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
</form>
@endsection
