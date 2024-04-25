@extends('layout.main')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Tambah Barang Masuk -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Tambah Data Barang Masuk</h5>
            <div class="card-body">
                <form method="post" action="/barang-masuk" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">Tanggal Masuk</label>
                                <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" placeholder="Tanggal Masuk" readonly />
                                @error('tanggal_masuk')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nameWithTitle" class="form-label">Produk</label>
                                <div class="input-group">
                                    <input type="text" name="produk_id" id="produk_id" class="form-control" hidden>
                                    <input type="text" name="barcode_data" id="barcode_data" class="form-control" required autofocus>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalItem">
                                        <i class="bx bx-search-alt-2"></i>
                                    </button>
                                </div>
                                @error('produk_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="dobWithTitle" class="form-label">Nama Produk</label>
                                <input type="text" id="nama_produk" name="nama_produk" class="form-control" placeholder="Nama Produk" disabled />
                            </div>
                            <div class="col-md-4">

                                <label for="dobWithTitle" class="form-label">Harga</label>
                                <input type="text" id="harga_produk" name="harga_produk" class="form-control" placeholder="Harga Produk" disabled />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="dobWithTitle" class="form-label">Stock Awal</label>
                                <input type="text" id="stock" name="stock" class="form-control" placeholder="Stock Awal" disabled />
                            </div>
                            <div class="col-md-6">
                                <div class="col mb-0">
                                    <label for="dobWithTitle" class="form-label">Jumlah</label>
                                    <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" />
                                    @error('jumlah')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!--END Tambah Barang Masuk -->

</div>

<div class="content-wrapper" style="margin-top: -40px;">

    {{-- START DAFTAR bARANG MASUK --}}
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Bordered Table -->
        <div class="card">
            <h5 class="card-header">Data Barang Masuk</h5>
            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
                @endif
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Masuk</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang_masuk as $bm)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span class="fw-medium">{{ $loop->iteration }}</span></td>
                                <td>{{ $bm->formatted_created_at }}</td>
                                <td>{{ $bm->produk->barcode_data }}</td>
                                <td>{{ $bm->produk->nama_produk }}</td>
                                <td>{{ $bm->jumlah }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item detail" data-bs-toggle="modal" data-bs-target="#modalDetail" data-id="{{ $bm->id }}">
                                                <i class="bx bx-detail me-1"></i>
                                                Detail
                                            </a>
                                            <a href="#" class="dropdown-item edit" data-bs-toggle="modal" data-bs-target="#modalEdit" data-id="{{ $bm->id }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form class="d-inline" style="display: inline" action="{{ url('/barang-masuk', $bm->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button class="dropdown-item" type="submit" onclick="return confirm('Apakah anda yakin untuk hapus data Users?')">
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
    {{-- END DAFTAR bARANG MASUK --}}

</div>


<!--START Modal Produk-->
<div class="modal fade" id="modalItem" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Pilih Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- START TABLE ITEM --}}
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Produk</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th>Stock</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($penjualan as $p)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span class="fw-medium">{{ $loop->iteration }}</span></td>
                                    <td>{{ $p->stand_id }}</td>
                                    <td>{{ $p->nama_produk }}</td>
                                    <td>{{ $p->jenis_barang->nama_jenis }}</td>
                                    <td>{{ 'Rp ' . number_format($p->harga_produk, 0, ',', '.') }}</td>
                                    <td>{{ $p->stock }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" id="pilih" data-id="{{ $p->id }}" data-barcode="{{ $p->barcode_data }}" data-nama="{{ $p->nama_produk }}" data-stock="{{ $p->stock }}" data-harga="{{ $p->harga_produk }}">
                                            <i class="bx bx-check me-1"></i> Pilih
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- END TABLE ITEM --}}
            </div>

        </div>
    </div>
</div>
<!-- END Modal Produk-->



<script>
    @if($errors - > any())
    $(document).ready(function() {
        $('#modalCenter').modal('show');
    });
    @endif
</script>
@endsection