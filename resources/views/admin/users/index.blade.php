<!--Bagian Halaman Awal Kelola User-->

@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Data User</h1>

<a href="{{ route('admin.users.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Tambah User</a>

@if(session('success'))
<div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
    {{ session('success') }}
</div>
@endif

<table class="table-auto w-full border border-gray-300 border-collapse">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">No</th>
            <th class="border border-gray-300 px-4 py-2">Nama</th>
            <th class="border border-gray-300 px-4 py-2">Email</th>
            <th class="border border-gray-300 px-4 py-2">Role</th>
            <th class="border border-gray-300 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $index => $user)
        <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $users->firstItem() + $index }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $user->role->name ?? '-' }}</td>
            <td class="border border-gray-300 px-4 py-2">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center p-4">Tidak ada data user</td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
