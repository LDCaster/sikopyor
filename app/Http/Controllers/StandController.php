<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StandModel;
use App\Models\User;

class StandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        $stand = StandModel::with(['users'])->get();

        return view('stand.index', [
            'title' => 'Data stand',
            'stand' => $stand,
            'users' => $users,
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
            'user_id' => 'User',
            'name_stand' => 'Nama Stand',
            'alamat' => 'Alamat',

        ];

        $request->validate([
            'user_id' => 'required|integer',
            'name_stand' => 'max:255',
            'alamat' => 'max:255',
        ], [], $customAttributes);

        $input = $request->all();

        $stand = StandModel::create($input);
        return redirect('/stand')->with('success', 'Data Berhasil Ditambahkan!');
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
        $stand = StandModel::findOrFail($id);
        return response()->json($stand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang dikirim dari form
        $customAttributes = [
            'user_id' => 'User',
            'name_stand' => 'Nama Stand',
            'alamat' => 'Alamat',
        ];

        $request->validate([
            'user_id' => 'required|integer',
            'name_stand' => 'max:255',
            'alamat' => 'max:255',
        ], [], $customAttributes);

        // Temukan stand yang akan diupdate berdasarkan ID
        $stand = StandModel::findOrFail($id);

        // Update data stand
        $stand->update([
            'user_id' => $request->user_id,
            'nama_stand' => $request->nama_stand,
            'alamat' => $request->alamat,
        ]);

        return redirect('/stand')->with('success', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stand = StandModel::find($id);

        // Cek apakah ada produk yang terkait dengan stand
        if ($stand->produk()->exists()) {
            // Jika ada produk terkait, hapus semua produk terkait dengan stand
            $stand->produk()->delete();
        }

        // Setelah menghapus produk terkait (jika ada), hapus stand
        $stand->delete();

        return redirect('/stand')->with('success', 'Data Berhasil Dihapus!');
    }
}
