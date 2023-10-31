@extends('layout.main')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">

  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bordered Table -->
    <div class="card">
      <h5 class="card-header">Data Users</h5>
      <div class="card-body">
        <a href="" class="btn rounded-pill btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCenter">Tambah</a>
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Role</th>
                <th>Nama </th>
                <th>No Telepone</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $u)

              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span class="fw-medium">{{ $loop->iteration }}</span></td>
                <td>{{ $u->role->nama_role}}</td>
                <td>
                  {{ $u->nama}}
                </td>
                <td>{{ $u->no_telp}}</td>
                <td>{{ $u->jenis_kelamin}}</td>
                <td>{{ $u->alamat}}</td>
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
        <h5 class="modal-title" id="modalCenterTitle">Tambah Data Users</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Role</label>
            <input type="text" id="role_id" class="form-control" placeholder="Role" />
          </div>
        </div>
        <div class="row g-2">
          <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Nama </label>
            <input type="text" id="nama" class="form-control" placeholder="Nama" />
          </div>
          <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">No Telp</label>
            <input type="text" id="no_telp" class="form-control" placeholder="No Telp" />
          </div>

        </div>
        <div class="row g-2">
          <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">Jenis Kelamin</label>
            <input type="text" id="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin" />
          </div>
          <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">Alamat</label>
            <input type="text" id="alamat" class="form-control" placeholder="Alamat" />
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