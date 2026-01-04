<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    // TAMPILKAN SEMUA DONASI
    public function index()
    {
        $donasis = Donasi::all();
        return view('welcome', compact('donasis'));
    }

    // TAMPILKAN FORM TAMBAH
    public function create()
    {
        return view('donasi.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'jenis_donasi' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('gambar');
        $namaFile = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('images'), $namaFile);

        Donasi::create([
            'nama_donatur' => $validated['nama_donatur'],
            'jenis_donasi' => $validated['jenis_donasi'],
            'jumlah' => $validated['jumlah'],
            'deskripsi' => $validated['deskripsi'],
            'gambar' => $namaFile,
        ]);

        return redirect('/')->with('success', 'Donasi berhasil ditambahkan.');
    }

    // TAMPILKAN FORM EDIT
    public function edit($id)
    {
        $donasi = Donasi::findOrFail($id);
        return view('donasi.edit', compact('donasi'));
    }

    // SIMPAN PERUBAHAN
    public function update(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'jenis_donasi' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $fileLama = public_path('images/' . $donasi->gambar);
            if (file_exists($fileLama)) {
                unlink($fileLama);
            }

            $namaFile = time() . '-' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('images'), $namaFile);
            $donasi->gambar = $namaFile;
        }

        $donasi->nama_donatur = $validated['nama_donatur'];
        $donasi->jenis_donasi = $validated['jenis_donasi'];
        $donasi->jumlah = $validated['jumlah'];
        $donasi->deskripsi = $validated['deskripsi'];

        $donasi->save();

        return redirect('/')->with('success', 'Donasi berhasil diperbarui.');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $donasi = Donasi::findOrFail($id);

        if ($donasi->gambar) {
            $fileLama = public_path('images/' . $donasi->gambar);
            if (file_exists($fileLama)) {
                unlink($fileLama);
            }
        }

        $donasi->delete();

        return redirect('/');
    }
}