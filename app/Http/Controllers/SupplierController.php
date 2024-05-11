<?php

namespace App\Http\Controllers;

use App\Models\JenisBarangModel;
use Illuminate\Http\Request;
use App\Models\SupplierModel;
use App\Models\User;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $supplier = SupplierModel::with(['jenis_barang'])->get();
        $jenisbarang = JenisBarangModel::get();


        return view('supplier.index', [
            'title' => 'Data Supplier',
            'supplier' => $supplier,
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
            'nama_toko' => 'Nama Toko',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
            'jenis_barang_id' => 'Jenis Barang',
        ];

        $request->validate([
            'nama_toko' => 'max:255|required|unique:supplier,nama_toko',
            'alamat' => 'max:255|required',
            'no_telp' => 'required|integer',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
        ], [], $customAttributes);

        $input = $request->all();

        $supplier = SupplierModel::create($input);
        return redirect('/supplier')->with('success', 'Data Berhasil Ditambahkan!');
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
        $supplier = SupplierModel::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customAttributes = [
            'nama_toko' => 'Nama Toko',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
            'jenis_barang_id' => 'Jenis Barang',
        ];

        $request->validate([
            'nama_toko' => 'max:255|required|unique:supplier,nama_toko,' . $id,
            'alamat' => 'max:255|required',
            'no_telp' => 'required|integer',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
        ], [], $customAttributes);

        $supplier = SupplierModel::findOrFail($id);
        $supplier->update($request->all());

        return redirect('/supplier')->with('success', 'Data Berhasil Diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SupplierModel::destroy($id);
        return redirect('/supplier')->with('success', 'Data Berhasil Dihapus!');
    }
}
