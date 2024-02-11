<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;
use App\Models\SatuanModel;
use App\Models\JenisBarangModel;
use App\Models\StandModel;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $namasatuan = SatuanModel::get();
        $namajenis = JenisBarangModel::get();
        $namastand = StandModel::get();
        $produk = ProdukModel::with(['stand', 'satuan', 'jenis_barang'])->get();
        // dd($produk);
        return view('produk.index', [
            'title' => 'Data Produk',
            'produk' => $produk,
            'namasatuan' => $namasatuan,
            'namajenis' => $namajenis,
            'namastand' => $namastand
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
            'stand_id' => 'Nama Stand',
            'nama_produk' => 'Nama Produk',
            'harga_produk' => 'Harga Produk',
            'stock' => 'Stock',
            'satuan_id' => 'Nama Satuan',
            'jenis_barang_id' => 'Jenis Barang',
            'barcode'  => 'Barcode',
            'foto_produk'  => 'Foto Produk'

        ];

        $request->validate([
            'stand_id' => 'required|max:255',
            'nama_produk'  => 'required|max:255',
            'harga_produk'  => 'required|integer',
            'stock'  => 'required|integer',
            'satuan_id'  => 'required|max:255',
            'jenis_barang_id'  => 'required|max:255',
            'barcode'  => 'integer|max:255',
            'foto_produk'  => 'mimes:jpeg,jpg,png,gif,svg|image|required'



        ], [], $customAttributes);

        $input = $request->all();
        if ($image = $request->file('foto_produk')) {
            $destinationPath = 'assets/img/produk';
            $profileImage = date('YmdHis') . "." . $image->extension();
            $image->move($destinationPath, $profileImage);
            $input['foto_produk'] = "$profileImage";
        } else {
            unset($input['foto_produk']);
        }

        $produk = ProdukModel::create($input);
        return redirect('/produk')->with('success', 'Data Berhasil Ditambahkan!');
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
        ProdukModel::destroy($id);
        return redirect('/produk')->with('success', 'Data Berhasil Dihapus!');
    }
}
