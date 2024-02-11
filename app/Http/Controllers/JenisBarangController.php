<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarangModel;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $jenisbarang = JenisbarangModel::get();

        return view('jenisbarang.index', [
            'title' => 'Data Jenis Barang',
            'jenisbarang' => $jenisbarang

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // menambahkan data
        $customAttributes = [
            'nama_jenis' => 'Nama Jenis'


        ];

        $request->validate([
            'nama_jenis' => 'required|max:255'

        ], [], $customAttributes);

        $input = $request->all();

        $jenisbarang = JenisBarangModel::create($input);
        return redirect('/jenis-barang')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisbarang = JenisBarangModel::find($id);

        // Cek apakah satuan memiliki keterkaitan dengan produk
        if ($jenisbarang->produk()->exists()) {
            return redirect('/jenis-barang')->with('error', 'Tidak dapat menghapus jenis barang yang memiliki keterkaitan dengan produk!');
        }

        // Jika tidak ada keterkaitan, hapus satuan
        $jenisbarang->delete();

        return redirect('/jenis-barang')->with('success', 'Data Berhasil Dihapus!');
    }
}
