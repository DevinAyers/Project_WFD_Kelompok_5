<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class LapanganController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::latest()->paginate(10);
        return view('admin.lapangans.index', compact('lapangans'));
    }

    public function create()
    {
        return view('admin.lapangans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('name', 'location', 'price', 'type');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('lapangan', 'public');
        }

        Lapangan::create($data);

        return redirect()->route('admin.lapangans.index')->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('admin.lapangans.show', compact('lapangan'));
    }

    public function edit($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('admin.lapangans.edit', compact('lapangan'));
    }

    public function update(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('name', 'location', 'price', 'type');

        if ($request->hasFile('image')) {
            if ($lapangan->image && Storage::disk('public')->exists($lapangan->image)) {
                Storage::disk('public')->delete($lapangan->image);
            }
            $data['image'] = $request->file('image')->store('lapangan', 'public');
        }

        $lapangan->update($data);

        return redirect()->route('admin.lapangans.index')->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);

        if ($lapangan->image && Storage::disk('public')->exists($lapangan->image)) {
            Storage::disk('public')->delete($lapangan->image);
        }

        $lapangan->delete();

        return redirect()->route('admin.lapangans.index')->with('success', 'Lapangan berhasil dihapus.');
    }
}
