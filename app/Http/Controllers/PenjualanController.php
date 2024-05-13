<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\PenjualanProdukModel;
use App\Models\ProdukModel;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = PenjualanModel::latest('kd_penjualan')->first();

        $lastKode = $penjualan ? $penjualan->kd_penjualan : 'IN0000';
        $newKode = 'IN' . str_pad((int)substr($lastKode, 2) + 1, 6, '0', STR_PAD_LEFT);

        $user = auth()->user();

        if ($user->role === 'admin') {
            $produk = ProdukModel::with('jenis_barang')->get();
        } else {
            $userStands = $user->stands;
            $userStandIds = $userStands->pluck('id');
            $produk = ProdukModel::with('jenis_barang')->whereIn('stand_id', $userStandIds)->get();
        }

        return view('penjualan.index', [
            'title' => 'Kasir',
            'penjualan' => $penjualan,
            'produk' => $produk,
            'newKode' => $newKode, // Mengirim nomor invoice baru ke view
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
        // dd($request->total_harga);

        // Validasi data
        $request->validate([
            'stand_id' => 'required',
            'tanggal_penjualan' => 'required|date', // Menggunakan nama kolom yang benar
            // tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
        // Simpan data penjualan
        $penjualan = PenjualanModel::create([
            'stand' => $request->stand_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'kd_penjualan' => $request->kd_penjualan,
            'total_harga' => $request->total_harga,
            // tambahkan kolom lain sesuai kebutuhan
        ]);

        // Simpan data penjualan produk
        $cartItems = json_decode($request->cartItems, true);
        // dd($cartItems);
        foreach ($cartItems as $item) {
            PenjualanProdukModel::create([
                'penjualan_id' => $penjualan->id,
                'produk_id' => $item['produk_id'],
                'jumlah' => $item['jumlah'],
            ]);
            // Kurangi jumlah produk dari stok
            $produk = ProdukModel::findOrFail($item['produk_id']);
            $produk->stock -= $item['jumlah'];
            $produk->save(); // Simpan perubahan stok
        }

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('kasir.index')->with('success', 'Data penjualan berhasil disimpan.');
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
