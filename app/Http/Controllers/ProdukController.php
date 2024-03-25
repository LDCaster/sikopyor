<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;
use App\Models\SatuanModel;
use App\Models\JenisBarangModel;
use App\Models\StandModel;
use Milon\Barcode\DNS1D;
use Picqer\Barcode\BarcodeGeneratorPNG;

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
    // public function store(Request $request)
    // {
    //     // menambahkan data 
    //     $customAttributes = [
    //         'stand_id' => 'Nama Stand',
    //         'nama_produk' => 'Nama Produk',
    //         'harga_produk' => 'Harga Produk',
    //         'stock' => 'Stock',
    //         'satuan_id' => 'Nama Satuan',
    //         'jenis_barang_id' => 'Jenis Barang',
    //         'barcode'  => 'Barcode',
    //         'foto_produk'  => 'Foto Produk'

    //     ];

    //     $request->validate([
    //         'stand_id' => 'required|max:255',
    //         'nama_produk'  => 'required|max:255',
    //         'harga_produk'  => 'required|integer',
    //         'stock'  => 'required|integer',
    //         'satuan_id'  => 'required|max:255',
    //         'jenis_barang_id'  => 'required|max:255',
    //         'barcode'  => 'max:255',
    //         'foto_produk'  => 'mimes:jpeg,jpg,png,gif,svg|image|required'
    //     ], [], $customAttributes);

    //     $input = $request->all();
    //     $input['barcode'] = 'PROD' . str_pad(ProdukModel::count() + 1, 6, '0', STR_PAD_LEFT);

    //     if ($image = $request->file('foto_produk')) {
    //         $destinationPath = 'assets/img/produk';
    //         $profileImage = date('YmdHis') . "." . $image->extension();
    //         $image->move($destinationPath, $profileImage);
    //         $input['foto_produk'] = "$profileImage";
    //     } else {
    //         unset($input['foto_produk']);
    //     }

    //     $produk = ProdukModel::create($input);
    //     return redirect('/produk')->with('success', 'Data Berhasil Ditambahkan!');
    // }
    public function store(Request $request)
    {
        $customAttributes = [
            'stand_id' => 'Nama Stand',
            'nama_produk' => 'Nama Produk',
            'harga_produk' => 'Harga Produk',
            'stock' => 'Stock',
            'satuan_id' => 'Nama Satuan',
            'jenis_barang_id' => 'Jenis Barang',
            'foto_produk' => 'Foto Produk'
        ];

        $request->validate([
            'stand_id' => 'required|max:255',
            'nama_produk'  => 'required|max:255',
            'harga_produk'  => 'required|integer',
            'stock'  => 'required|integer',
            'satuan_id'  => 'required|max:255',
            'jenis_barang_id'  => 'required|max:255',
            'foto_produk'  => 'mimes:jpeg,jpg,png,gif,svg|image|required'
        ], [], $customAttributes);

        $input = $request->all();
        $input['barcode'] = 'PROD' . str_pad(ProdukModel::count() + 1, 6, '0', STR_PAD_LEFT);

        if ($image = $request->file('foto_produk')) {
            $destinationPath = 'assets/img/produk';
            $profileImage = date('YmdHis') . "." . $image->extension();
            $image->move($destinationPath, $profileImage);
            $input['foto_produk'] = "$profileImage";
        } else {
            unset($input['foto_produk']);
        }

        // Generate barcode
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = 'data:image/png;base64,' . base64_encode($generator->getBarcode($input['barcode'], $generator::TYPE_CODE_128));
        $input['barcode'] = $barcodeImage;

        // Tambahkan barcode_data
        $input['barcode_data'] = 'PROD' . str_pad(ProdukModel::count() + 1, 6, '0', STR_PAD_LEFT);

        $produk = ProdukModel::create($input);
        return redirect('/produk')->with('success', 'Data Berhasil Ditambahkan!');
    }


    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $produk = ProdukModel::with(['stand', 'satuan', 'jenis_barang'])->findOrFail($id);

        // Generate barcode jika belum ada
        if (!$produk->barcode) {
            $generator = new BarcodeGeneratorPNG();
            $barcodeImage = 'data:image/png;base64,' . base64_encode($generator->getBarcode($produk->barcode, $generator::TYPE_CODE_128));
            $produk->barcode = $barcodeImage;
            $produk->save();
        }

        return response()->json($produk);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = ProdukModel::findOrFail($id);
        return response()->json($produk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customAttributes = [
            'stand_id' => 'Nama Stand',
            'nama_produk' => 'Nama Produk',
            'harga_produk' => 'Harga Produk',
            'stock' => 'Stock',
            'satuan_id' => 'Nama Satuan',
            'jenis_barang_id' => 'Jenis Barang',
            'foto_produk' => 'Foto Produk'
        ];

        $request->validate([
            'stand_id' => 'required|max:255',
            'nama_produk'  => 'required|max:255',
            'harga_produk'  => 'required|integer',
            'stock'  => 'required|integer',
            'satuan_id'  => 'required|max:255',
            'jenis_barang_id'  => 'required|max:255',
            'foto_produk'  => 'sometimes|mimes:jpeg,jpg,png,gif,svg|image'
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

        $produk = ProdukModel::findOrFail($id);
        $produk->update($input);

        return redirect('/produk')->with('success', 'Data Berhasil Diupdate!');
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
