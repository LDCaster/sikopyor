<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleModel;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = RoleModel::get();
        $users = User::with(['role'])->get();

        return view('users.index', [
            'title' => 'Data users',
            'users' => $users,
            'role' => $role

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
            'role_id' => 'Role',
            'name' => 'Nama',
            'no_telp' => 'Nomor Telepon',
            'jenis_kelamin' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'img' => 'Foto',
            'email' => 'Email',
            'password' => 'Password',
        ];

        $request->validate([
            'role_id' => 'required|integer',
            'name' => 'max:255',
            'no_telp' => 'max:13',
            'jenis_kelamin' => 'max:255|required',
            'alamat' => 'max:255',
            'img' => 'mimes:jpeg,jpg,png,gif,svg|image|required',
            'email' => 'max:255|required',
            'password' => 'max:255|required',
        ], [], $customAttributes);

        $request['password'] = Hash::make($request->password);
        $input = $request->all();

        if ($image = $request->file('img')) {
            $destinationPath = 'assets/img/profile';
            $profileImage = date('YmdHis') . "." . $image->extension();
            $image->move($destinationPath, $profileImage);
            $input['img'] = "$profileImage";
        } else {
            unset($input['img']);
        }

        $user = User::create($input);
        return redirect('/users')->with('success', 'Data Berhasil Ditambahkan!');
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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|integer',
            'name' => 'max:255',
            'no_telp' => 'max:13',
            'jenis_kelamin' => 'max:255|required',
            'alamat' => 'max:255',
            'img' => 'mimes:jpeg,jpg,png,gif,svg|image',
            'email' => 'max:255|required',
        ]);

        $user = User::findOrFail($id);
        $input = $request->except('password');

        // Periksa jika ada pengiriman gambar baru
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $destinationPath = 'assets/img/profile';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['img'] = $profileImage;
        }
        // Update password jika diminta
        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->input('password'));
        }
        // Update user
        $user->update($input);

        return redirect('/users')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        // Cek apakah pengguna memiliki keterkaitan dengan stand
        if ($user->stands()->exists()) {
            return redirect('/users')->with('error', 'Tidak dapat menghapus pengguna yang memiliki keterkaitan dengan stand!');
        }

        // Jika tidak ada keterkaitan, hapus pengguna
        $user->delete();

        return redirect('/users')->with('success', 'Data Berhasil Dihapus!');
    }
}
