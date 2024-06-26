@extends('layout.main')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Bordered Table -->
            <div class="card">
                <h5 class="card-header">Data Satuan</h5>
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
                                    <th>Nama Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($satuan as $s)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span
                                                class="fw-medium">{{ $loop->iteration }}</span></td>
                                        <td>{{ $s->nama_satuan }}</td>
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
                                                        action="{{ url('/satuan', $s->id) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="dropdown-item" type="submit"
                                                            onclick="return confirm('Apakah anda yakin untuk hapus data Satuan?')">
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
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Satuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/satuan">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Nama Satuan</label>
                                <input type="text" id="nama_satuan" name="nama_satuan" class="form-control"
                                    placeholder="Nama Satuan" />
                                @error('nama_satuan')
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

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Data Satuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="nama_satuan" class="form-label">Nama Satuan</label>
                                <input type="text" id="nama_satuan_edit" name="nama_satuan" class="form-control"
                                    placeholder="Nama Satuan" />
                                @error('nama_satuan')
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
                    url: `/satuan/${id}/edit`,
                    method: "get",
                    success: function(data) {
                        console.log(data);
                        $('#nama_satuan_edit').val(data.nama_satuan);
                        $('#editForm').attr('action', `/satuan/${id}`); // Perbaikan nama form
                    }
                });
            });
        });
    </script>
@endsection
