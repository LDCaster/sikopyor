<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {

        $supplier = PenjualanModel::get();


        return view('penjualan.index', [
            'title' => 'Kasir',
            'penjualan' => $supplier

        ]);
    }
}
