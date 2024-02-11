<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SatuanModel;
use App\Models\Satuan;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $satuans = SatuanModel::get();

        return view('satuan.index', [
            'title' => 'Data Satuan',
            'satuan' => $satuans
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
            'nama_satuan' => 'Nama Satuan'
        ];

        $request->validate([
            'nama_satuan' => 'required|max:255',
        ], [], $customAttributes);

        $input = $request->all();

        $satuan = SatuanModel::create($input);
        return redirect('/satuan')->with('success', 'Data Berhasil Ditambahkan!');
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
        $satuan = SatuanModel::find($id);

        // Cek apakah satuan memiliki keterkaitan dengan produk
        if ($satuan->produk()->exists()) {
            return redirect('/satuan')->with('error', 'Tidak dapat menghapus satuan yang memiliki keterkaitan dengan produk!');
        }

        // Jika tidak ada keterkaitan, hapus satuan
        $satuan->delete();

        return redirect('/satuan')->with('success', 'Data Berhasil Dihapus!');
    }
}
