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
        <a href="" class="btn rounded-pill btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCenter">Tambah</a>
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
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span class="fw-medium">{{ $loop->iteration }}</span></td>
                <td>{{ $p->stand->nama_stand }}</td>
                <td>
                  {{ $p->nama_produk}}
                </td>
                <td>{{ $p->harga_produk}}</td>
                <td>{{ $p->stock}}</td>
                <td>{{ $p->satuan->nama_satuan}}</td>
                <td>{{ $p->jenis_barang->nama_jenis}}</td>
                <td>{{ $p->foto_produk}}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                      <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
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
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Nama Stand</label>
            <input type="text" id="stand_id" class="form-control" placeholder="Karyawan" />
          </div>
        </div>
        <div class="row g-2">
          <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Nama Produk</label>
            <input type="text" id="nama_produk" class="form-control" placeholder="nama produk" />
          </div>
          <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">Harga Produk</label>
            <input type="text" id="harga_produk" class="form-control" placeholder="harga produk" />
          </div>
        </div>
        <div class="row g-2">
          <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Stock</label>
            <input type="text" id="stock" class="form-control" placeholder="stock" />
          </div>
          <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">Nama Satuan</label>
            <input type="text" id="satuan_id" class="form-control" placeholder="nama satuan" />
          </div>
        </div>
        <div class="row g-2">
          <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Nama Jenis</label>
            <input type="text" id="jenis_barang_id" class="form-control" placeholder="nama jenis" />
          </div>
          <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">Barcode</label>
            <input type="text" id="barcode" class="form-control" placeholder="barcode" />
          </div>
        </div>
        <div class="row g-2">
          <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Foto Produk</label>
            <input type="text" id="foto_produk" class="form-control" placeholder="foto produk" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection