<?php

namespace App\Http\Controllers;

use App\Models\BarangMasukModel;
use App\Models\ProdukModel;
use App\Models\StandModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_barang_masuk = BarangMasukModel::with('produk')->get();

        $produk = ProdukModel::with('jenis_barang')->get();

        $barang_masuk = $data_barang_masuk->map(function ($bm) {
            $bm->formatted_created_at = Carbon::parse($bm->created_at)->format('d F Y');
            return $bm;
        });

        return view('barang_masuk.index', [
            'title' => 'Data Barang Masuk (Stock IN)',
            'barang_masuk' => $barang_masuk,
            'produk' => $produk
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
        $request->validate([
            'barcode_data' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        // Buat data barang masuk
        $barang_masuk = new BarangMasukModel;
        $barang_masuk->produk_id = $request->produk_id;
        $barang_masuk->jumlah = $request->jumlah;
        $barang_masuk->save();

        return redirect('/barang-masuk')->with('success', 'Data barang masuk berhasil ditambahkan.');
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
        //
    }
}
