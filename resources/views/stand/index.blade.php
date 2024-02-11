@extends('layout.main')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Bordered Table -->
            <div class="card">
                <h5 class="card-header">Data Stand</h5>
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
                                    <th>Nama Karyawan</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stand as $s)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span
                                                class="fw-medium">{{ $loop->iteration }}</span></td>
                                        <td>{{ $s->nama_stand }}</td>
                                        <td>
                                            {{ $s->users->nama }}
                                        </td>
                                        <td>{{ $s->alamat }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form class="d-inline" style="display: inline"
                                                        action="{{ url('/stand', $s->id) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="dropdown-item" type="submit"
                                                            onclick="return confirm('Apakah anda yakin untuk hapus data Stand dan data yang terkait?')">
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
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Stand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/stand">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Karyawan</label>
                                <select id="user_id" name="user_id" class="select2 form-select" data-allow-clear="true">
                                    <option value="">--- Pilih Karyawan ---</option>
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}">
                                            {{ $u->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Nama Stand</label>
                                <input type="text" id="nama_stand" name="nama_stand" class="form-control"
                                    placeholder="Nama_Stand" />
                                @error('nama_stand')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control"
                                    placeholder="Alamat" />
                                @error('alamat')
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
