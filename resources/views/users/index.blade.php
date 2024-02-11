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
                                    <th>Nama Role</th>
                                    <th>Nama </th>
                                    <th>No Telepone</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span
                                                class="fw-medium">{{ $loop->iteration }}</span></td>
                                        <td>{{ $u->role->nama_role }}</td>
                                        <td>
                                            {{ $u->nama }}
                                        </td>
                                        <td>{{ $u->no_telp }}</td>
                                        <td>{{ $u->jenis_kelamin }}</td>
                                        <td>{{ $u->alamat }}</td>
                                        <td>
                                            @if ($u->img)
                                                <img style="max-width:50px; max-height:50px"
                                                    src="{{ url('/assets/img/profile') . '/' . $u->img }}">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item" value="{{ $u->id }}"
                                                        data-toggle="modal" data-target="#ModalEdit">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </button>
                                                    <form class="d-inline" style="display: inline"
                                                        action="{{ url('/users', $u->id) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="dropdown-item" type="submit"
                                                            onclick="return confirm('Apakah anda yakin untuk hapus data Users dan data yang terkait?')">
                                                            <i class="bx bx-trash me-1"></i> Delete</button>
                                                    </form>
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
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/users" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Role</label>
                                <select id="role_id" name="role_id" class="select2 form-select" data-allow-clear="true">
                                    <option value="">--- Pilih Role ---</option>
                                    @foreach ($role as $r)
                                        <option value="{{ $r->id }}">
                                            {{ $r->nama_role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Nama </label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    placeholder="Nama" />
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">No Telp</label>
                                <input type="text" id="no_telp" name="no_telp" class="form-control"
                                    placeholder="No Telp" />
                                @error('no_telp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">--- Pilih Jenis Kelamin ---</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Alamat </label>
                                <input type="text" id="alamat" name="alamat" class="form-control"
                                    placeholder="Alamat" />
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="img" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="img" name="img">
                                @error('img')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Email </label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Alamat" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Password </label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Password" />
                                @error('password')
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
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Data Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/users" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Role</label>
                                <select id="role_id" name="role_id" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">--- Pilih Role ---</option>
                                    @foreach ($role as $r)
                                        <option value="{{ $r->id }}">
                                            {{ $r->nama_role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Nama </label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    placeholder="Nama" />
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">No Telp</label>
                                <input type="text" id="no_telp" name="no_telp" class="form-control"
                                    placeholder="No Telp" />
                                @error('no_telp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-0">
                                <label for="dobWithTitle" class="form-label">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">--- Pilih Jenis Kelamin ---</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Alamat </label>
                                <input type="text" id="alamat" name="alamat" class="form-control"
                                    placeholder="Alamat" />
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="img" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="img" name="img">
                                @error('img')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Email </label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Alamat" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailWithTitle" class="form-label">Password </label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Password" />
                                @error('password')
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

        $(document).ready(function() {

            $('.edit').click(function() {
                const id = $(this).val()
                $.ajax({
                    url: {{ url('/users/${id}/edit') }},
                    method: "get",
                    success: function(data) {
                        $('#role_id').val(data.role_id)
                        $('#nama').val(data.nama)
                        $('#no_telp').val(data.no_telp)
                        $('#jenis_kelamin').val(data.jenis_kelamin)
                        $('#alamat').val(data.alamat)
                        $('#img').val(data.img)
                        $('#email').val(data.email)
                        $('#ModalEdit form').attr('action',
                            {{ url('users/${id}') }})
                    }
                })
            })
        })
    </script>
@endsection
