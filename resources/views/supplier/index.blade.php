@extends('layout.main')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Bordered Table -->
            <div class="card">
                <h5 class="card-header">Data Supplier</h5>
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
                                    <th>Jenis Barang</th>
                                    <th>Nama Toko</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplier as $s)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span
                                                class="fw-medium">{{ $loop->iteration }}</span></td>
                                        <td>{{ $s->jenis_barang->nama_jenis }}</td>
                                        <td>{{ $s->nama_toko }}</td>
                                        <td>
                                            {{ $s->alamat }}
                                        </td>
                                        <td>{{ $s->no_telp }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a href="#" class="dropdown-item edit" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit" data-id="{{ $s->id }}">
                                                        <i class="bx bx-edit-alt me-1"></i>
                                                        Edit
                                                    </a>
                                                    <form class="d-inline" style="display: inline"
                                                        action="{{ url('/supplier', $s->id) }}" method="POST">
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/supplier">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Nama Toko</label>
                                <input type="text" id="nama_toko" name="nama_toko" class="form-control"
                                    placeholder="Nama Toko" />
                                @error('nama_toko')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Jenis Barang</label>
                                <select id="jenis_barang_id" name="jenis_barang_id" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">--- Pilih Jenis Barang ---</option>
                                    @foreach ($jenisbarang as $jb)
                                        <option value="{{ $jb->id }}">
                                            {{ $jb->nama_jenis }}
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
                                <label for="emailWithTitle" class="form-label">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control"
                                    placeholder="Alamat" />
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">No Telepone</label>
                                <input type="text" id="no_telp" name="no_telp" class="form-control"
                                    placeholder="No Telp" />
                                @error('no_telp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="subbmit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama_toko_edit" class="form-label">Nama Toko</label>
                                <input type="text" id="nama_toko_edit" name="nama_toko" class="form-control"
                                    placeholder="Nama Toko" />
                                @error('nama_toko')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Jenis</label>
                                <select id="edit_jenis_barang_id" name="jenis_barang_id" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">--- Pilih Jenis ---</option>
                                    @foreach ($jenisbarang as $jb)
                                        <option value="{{ $jb->id }}">
                                            {{ $jb->nama_jenis }}
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
                                <label for="alamat_edit" class="form-label">Alamat</label>
                                <input type="text" id="alamat_edit" name="alamat" class="form-control"
                                    placeholder="Alamat" />
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-0">
                                <label for="no_telp_edit" class="form-label">No Telepone</label>
                                <input type="text" id="no_telp_edit" name="no_telp" class="form-control"
                                    placeholder="No Telp" />
                                @error('no_telp')
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

        // Tampil Edit
        $(document).ready(function() {
            $('.edit').click(function() {
                const id = $(this).data('id'); // Menggunakan data-id
                $.ajax({
                    url: `/supplier/${id}/edit`,
                    method: "get",
                    success: function(data) {
                        console.log(data);
                        $('#nama_toko_edit').val(data.nama_toko);
                        $('#edit_jenis_barang_id').val(data.jenis_barang_id).trigger('change');
                        $('#alamat_edit').val(data.alamat);
                        $('#no_telp_edit').val(data.no_telp);
                        $('#editForm').attr('action', `/supplier/${id}`); // Perbaikan nama form
                    }
                });
            });
        });
    </script>
@endsection
