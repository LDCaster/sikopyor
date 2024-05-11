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
        $user = auth()->user();

        if ($user->role === 'admin') {
            $produk = ProdukModel::with('jenis_barang')->get();
        } else {
            $userStands = $user->stands;
            $userStandIds = $userStands->pluck('id');
            $produk = ProdukModel::with('jenis_barang')->whereIn('stand_id', $userStandIds)->get();
        }

        $data_barang_masuk = BarangMasukModel::with('produk')->get();

        // Filter barang masuk sesuai stand user yang login, kecuali admin
        if ($user->role !== 'admin') {
            $data_barang_masuk = $data_barang_masuk->filter(function ($bm) use ($userStandIds) {
                return $userStandIds->contains($bm->produk->stand_id);
            });
        }

        $barang_masuk = $data_barang_masuk->map(function ($bm) {
            $bm->formatted_created_at = Carbon::parse($bm->created_at)->format('d F Y');
            return $bm;
        });

        // dd($barang_masuk);

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
        $barang_masuk->created_at = Carbon::now()->setTimezone('Asia/Singapore');
        $barang_masuk->save();

        // Update stock produk
        $produk = ProdukModel::find($request->produk_id);
        $produk->stock += $request->jumlah;
        $produk->save();

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
        $barang_masuk = BarangMasukModel::findOrFail($id);

        // Konversi waktu server (UTC) ke waktu Singapura
        $created_at_sg = Carbon::parse($barang_masuk->created_at)->setTimezone('Asia/Singapore');

        // Cek apakah data sudah lebih dari 1 hari dibuat (dalam zona waktu Singapura)
        if ($created_at_sg->diffInDays(now()) >= 1) {
            return redirect('/barang-masuk')->with('error', 'Data barang masuk tidak dapat dihapus karena sudah lebih dari 1 hari ditambah.');
        }


        // Kurangi stock produk
        $produk = ProdukModel::find($barang_masuk->produk_id);
        $produk->stock -= $barang_masuk->jumlah;
        $produk->save();

        // Hapus data barang masuk
        $barang_masuk->delete();

        return redirect('/barang-masuk')->with('success', 'Data barang masuk berhasil dihapus.');
    }
}
