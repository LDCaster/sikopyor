@extends('layout.main')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Bordered Table -->
            <div class="card">
                <h5 class="card-header">Data Produk</h5>
                <div class="card-body">
                    <a href="" class="btn rounded-pill btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#modalCenter">Tambah</a>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Stand</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Stock</th>
                                    <th>Nama Satuan</th>
                                    <th>Jenis Barang</th>
                                    <th>Foto Produk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $p)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span
                                                class="fw-medium">{{ $loop->iteration }}</span></td>
                                        <td>{{ $p->stand->nama_stand }}</td>
                                        <td>
                                            {{ $p->nama_produk }}
                                        </td>
                                        <td>{{ $p->harga_produk }}</td>
                                        <td>{{ $p->stock }}</td>
                                        <td>
                                            @if ($p->satuan)
                                                {{ $p->satuan->nama_satuan }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->jenis_barang)
                                                {{ $p->jenis_barang->nama_jenis }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->foto_produk)
                                                <img style="max-width:100px; max-height:100px"
                                                    src="{{ url('/assets/img/produk') . '/' . $p->foto_produk }}">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form class="d-inline" style="display: inline"
                                                        action="{{ url('/produk', $p->id) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="dropdown-item" type="submit"
                                                            onclick="return confirm('Apakah anda yakin untuk hapus data Users?')">
                                                            <i class="bx bx-trash me-1"></i> Delete</button>
                                                    </form>>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/produk"enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Stand</label>
                                <select id="stand_id" name="stand_id" class="select2 form-select" data-allow-clear="true">
                                    <option value="">--- Pilih Stand ---</option>
                                    @foreach ($namastand as $ns)
                                        <option value="{{ $ns->id }}">
                                            {{ $ns->nama_stand }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('stand_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Nama Produk</label>
                                <input type="text" id="nama_produk" name="nama_produk" class="form-control"
                                    placeholder="Nama Produk" />
                                @error('nama_produk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">Harga Produk</label>
                                <input type="text" id="harga_produk" name="harga_produk" class="form-control"
                                    placeholder="Harga Produk" />
                                @error('harga_produk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Stock</label>
                                <input type="text" id="stock" name="stock" class="form-control"
                                    placeholder="Stock" />
                                @error('stock')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">Satuan</label>
                                <select id="satuan_id" name="satuan_id" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">--- Pilih Satuan ---</option>
                                    @foreach ($namasatuan as $ns)
                                        <option value="{{ $ns->id }}">
                                            {{ $ns->nama_satuan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_barang_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Jenis</label>
                                <select id="jenis_barang_id" name="jenis_barang_id" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">--- Pilih Jenis ---</option>
                                    @foreach ($namajenis as $nj)
                                        <option value="{{ $nj->id }}">
                                            {{ $nj->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_barang_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">Barcode</label>
                                <input type="text" id="barcode" name="barcode"class="form-control"
                                    placeholder="barcode" />
                                @error('barcode')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="foto_produk" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="foto_produk" name="foto_produk">
                                @error('foto_produk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        @if ($errors->any())
            $(document).ready(function() {
                $('#modalCenter').modal('show');
            });
        @endif
    </script>
@endsection
