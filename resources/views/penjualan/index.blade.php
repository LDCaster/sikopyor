@extends('layout.main')

@section('content')
    <!-- Tambah Data Invoice -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-5">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <h6>Invoice</h6>
                                    <h5 style="font-weight: bold;">IN100000</h5>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label"
                                            style="font-weight: bold;">Tanggal</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control"
                                            readonly />
                                        @error('tanggal_masuk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label"
                                            style="font-weight: bold;">Kasir</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="kasir" name="kasir" class="form-control"
                                            placeholder="Nama Kasir" disabled />
                                        @error('kasir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label"
                                            style="font-weight: bold;">Customer</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="customer" name="customere" class="form-control"
                                            value="Umum" />
                                        @error('customer')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="nameWithTitle" class="form-label">Produk</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="produk_id" id="produk_id" class="form-control" hidden>
                                        <input type="text" name="barcode_data" id="barcode_data" class="form-control"
                                            required autofocus>
                                    </div>
                                    <div class="col-md-2" style="margin-left: -20px;">
                                        <button type="button" class="btn btn-info " data-bs-toggle="modal"
                                            data-bs-target="#modalItem">
                                            <i class="bx bx-search-alt-2"></i>
                                        </button>
                                    </div>
                                    @error('tanggal_masuk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row" style="margin-bottom: 34px;">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label"
                                            style="font-weight: bold;">Jumlah</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="jumlah" name="jumlah" class="form-control"
                                            value="1" />
                                        @error('jumlah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-plus'></i> Tambah
                                        </button>
                                        @error('jumlah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>
    <!--END Tambah Invoice -->

    <div class="content-wrapper" style="margin-top: -100px; margin-bottom: -40px;">

        {{-- START DAFTAR Produk --}}
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Bordered Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>PRO23</td>
                                    <td>Pop ICE</td>
                                    <td>5000</td>
                                    <td>2</td>
                                    <td>10000</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!--/ Bordered Table -->

        </div>
        {{-- END DAFTAR Produk --}}

    </div>

    <!-- Tambah Aksi Payment -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-5">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label"
                                            style="font-weight: bold;">Subtotal</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="kasir" name="kasir" class="form-control"
                                            placeholder="0" disabled />
                                        @error('tanggal_masuk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label"
                                            style="font-weight: bold;">Discount</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="kasir" name="kasir" class="form-control"
                                            placeholder="0" />
                                        @error('kasir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label" style="font-weight: bold;">Grand
                                            Total</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="customer" name="customere" class="form-control"
                                            value="0" disabled />
                                        @error('customer')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label"
                                            style="font-weight: bold;">Cash</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="kasir" name="kasir" class="form-control" />
                                        @error('tanggal_masuk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label"
                                            style="font-weight: bold;">Change</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="kasir" name="kasir" class="form-control"
                                            disabled />
                                        @error('kasir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">
                                    <i class='bx bxs-send'></i> Payment Process
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>
    <!--END Tambah Aksi Payment -->

    <script>
        @if ($errors->any())
            $(document).ready(function() {
                $('#modalCenter').modal('show');
            });
        @endif
    </script>
@endsection
