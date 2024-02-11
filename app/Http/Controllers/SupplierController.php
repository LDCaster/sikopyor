<?php

namespace App\Http\Controllers;

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

        $supplier = SupplierModel::get();


        return view('supplier.index', [
            'title' => 'Data Supplier',
            'supplier' => $supplier

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

        ];

        $request->validate([
            'nama_toko' => 'max:255|required',
            'alamat' => 'max:255|required',
            'no_telp' => 'required|integer'
        ], [], $customAttributes);

        $input = $request->all();

        $supplier = SupplierModel::create($input);
        return redirect('/supplier')->with('success', 'Data Berhasil Ditambahkan!');
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
        SupplierModel::destroy($id);
        return redirect('/supplier')->with('success', 'Data Berhasil Dihapus!');
    }
}
