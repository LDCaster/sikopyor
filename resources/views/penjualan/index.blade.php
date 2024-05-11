@extends('layout.main')

@section('content')
    <!-- Tambah Data Invoice -->

    <!--START Modal List Produk-->
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
                                    @foreach ($produk as $p)
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <span
                                                    class="fw-medium">{{ $loop->iteration }}</span></td>
                                            <td>{{ $p->barcode_data }}</td>
                                            <td>{{ $p->nama_produk }}</td>
                                            <td>{{ $p->jenis_barang->nama_jenis }}</td>
                                            <td>{{ 'Rp ' . number_format($p->harga_produk, 0, ',', '.') }}</td>
                                            <td>{{ $p->stock }}</td>
                                            <td>
                                                <button class="btn btn-xs btn-info" id="pilih"
                                                    data-id="{{ $p->id }}" data-barcode="{{ $p->barcode_data }}"
                                                    data-nama="{{ $p->nama_produk }}" data-stock="{{ $p->stock }}"
                                                    data-harga="{{ $p->harga_produk }}">
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
    <!-- END Modal List Produk-->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-5">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <h6>Invoice</h6>
                                    <h5 style="font-weight: bold;">{{ $newKode }}</h5>
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
                                        <label for="kasir" class="form-label" style="font-weight: bold;">Kasir</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="nama" name="nama" class="form-control"
                                            placeholder="{{ Auth::user()->nama }}" disabled />
                                        @error('nama')
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
                                        <input type="text" name="stand_id" id="stand_id" class="form-control"
                                            value="{{ auth()->user()->stands->first()->nama_stand ?? '' }}" hidden>
                                        <input type="text" name="produk_id" id="produk_id" class="form-control" hidden>
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control"
                                            hidden>
                                        <input type="text" name="harga_produk" id="harga_produk" class="form-control"
                                            hidden>
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
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-4">
                                        <label for="tanggal_masuk" class="form-label" style="font-weight: bold;">Stock
                                            Awal</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="stock" name="stock" class="form-control"
                                            disabled />
                                        @error('stock')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                                    <div class="col-md-8" style="margin-top: -20px; margin-bottom: -18px;">
                                        <button type="button" id="tambah_button" class="btn btn-primary">
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

        <!-- START Keranjang -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Bordered Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" id="keranjang">
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
                                <!-- Dynamic rows will be added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Bordered Table -->
        </div>
        <!-- END Keranjang -->


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
                                        <label for="subtotal" class="form-label"
                                            style="font-weight: bold;">Subtotal</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="subtotal" name="subtotal" class="form-control"
                                            placeholder="0" disabled />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="discount" class="form-label"
                                            style="font-weight: bold;">Discount</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="discount" name="discount" class="form-control"
                                            placeholder="0" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="grandTotal" class="form-label" style="font-weight: bold;">Grand
                                            Total</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="grandTotal" name="grandTotal" class="form-control"
                                            value="0" disabled />
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
                                        <label for="cash" class="form-label" style="font-weight: bold;">Cash</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="cash" name="cash" class="form-control" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="change" class="form-label"
                                            style="font-weight: bold;">Change</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="change" name="change" class="form-control"
                                            disabled />
                                    </div>
                                </div>
                                <button type="submit" id="paymentButton" class="btn btn-info">
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
        // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        var today = new Date().toISOString().slice(0, 10);

        // Mengatur nilai input tanggal_masuk menjadi tanggal hari ini
        document.getElementById('tanggal_masuk').value = today;


        @if ($errors->any())
            $(document).ready(function() {
                $('#modalCenter').modal('show');
            });
        @endif
    </script>

    <script>
        // START MENAMPILKAN DATA PRODUK DI TAMBAH BARANG MASUK
        $(document).ready(function() {
            $(document).on('click', '#pilih', function() {
                var produk_id = $(this).data('id');
                var barcode_data = $(this).data('barcode');
                var nama_produk = $(this).data('nama');
                var harga_produk = $(this).data('harga');
                var stock = $(this).data('stock');
                $('#produk_id').val(produk_id);
                $('#barcode_data').val(barcode_data);
                $('#nama_produk').val(nama_produk);
                $('#harga_produk').val(harga_produk);
                $('#stock').val(stock);
                $('#modalItem').modal('hide');
            })
        })
        // END MENAMPILKAN DATA PRODUK DI TAMBAH BARANG MASUK


        // Add selected product to the table
        $('#tambah_button').click(function() {
            // Disable the button to prevent multiple clicks
            $(this).prop('disabled', true);

            var kode_produk = $('#barcode_data').val();
            var nama_produk = $('#nama_produk').val();
            var harga_produk = $('#harga_produk').val();
            var jumlah = $('#jumlah').val();
            var stock = $('#stock').val(); // Get the available stock
            var total = harga_produk * jumlah;

            // Check if the entered quantity exceeds the available stock
            if (parseInt(jumlah) > parseInt(stock)) {
                jumlah = stock; // Set the quantity to the available stock
                total = harga_produk * jumlah; // Recalculate the total
            }

            // Check if the product already exists in the table
            var existingRow = $('#keranjang tbody tr').filter(function() {
                return $(this).find('td:nth-child(2)').text() === kode_produk;
            });

            // Calculate total quantity of the product in the cart
            var totalQuantityInCart = 0;
            $('#keranjang tbody tr').each(function() {
                if ($(this).find('td:nth-child(2)').text() === kode_produk) {
                    totalQuantityInCart += parseInt($(this).find('td:nth-child(5)').text());
                }
            });

            // Calculate the quantity to be added
            var remainingStock = parseInt(stock) - totalQuantityInCart;
            var quantityToAdd = Math.min(parseInt(jumlah), remainingStock);

            // If the product exists, update its quantity and total
            if (existingRow.length > 0) {
                var existingJumlah = parseInt(existingRow.find('td:nth-child(5)').text());
                var newJumlah = existingJumlah + parseInt(quantityToAdd);
                var newTotal = harga_produk * newJumlah;

                existingRow.find('td:nth-child(5)').text(newJumlah);
                existingRow.find('td:nth-child(6)').text(newTotal);
            } else {
                // Append a new row to the table body
                $('#keranjang tbody').append(`
            <tr>
                <td></td>
                <td>${kode_produk}</td>
                <td>${nama_produk}</td>
                <td>${harga_produk}</td>
                <td>${quantityToAdd}</td>
                <td>${harga_produk * quantityToAdd}</td>
                <td>
                    <button class="btn btn-danger btn-sm hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</button>
                </td>
            </tr>
        `);
            }

            // Enable the button after the operation is completed
            $(this).prop('disabled', false);
        });

        // Remove row when the "Hapus" button is clicked
        $(document).on('click', '.hapus', function() {
            $(this).closest('tr').remove();
        });
    </script>

    <script>
        $(document).ready(function() {
            // Calculate subtotal, discount, and grand total
            function calculateTotals() {
                var subtotal = 0;
                $('#keranjang tbody tr').each(function() {
                    subtotal += parseFloat($(this).find('td:nth-child(6)').text());
                });

                var discountPercentage = parseFloat($('#discount').val()) || 0;
                var discountAmount = (subtotal * discountPercentage) / 100;
                var grandTotal = subtotal - discountAmount;

                $('#subtotal').val(subtotal.toFixed(2));
                $('#discountAmount').val(discountAmount.toFixed(2));
                $('#grandTotal').val(grandTotal.toFixed(2));
            }

            // Update change amount
            function updateChange() {
                var cash = parseFloat($('#cash').val()) || 0;
                var grandTotal = parseFloat($('#grandTotal').val()) || 0;
                var change = cash - grandTotal;

                $('#change').val(change.toFixed(2));
            }

            // Call calculateTotals on initial load
            calculateTotals();

            // Call calculateTotals when the discount input changes
            $('#discount').on('input', function() {
                calculateTotals();
            });

            // Call updateChange when the cash input changes
            $('#cash').on('input', function() {
                updateChange();
            });

            // Payment process
            $('#paymentButton').click(function() {
                var cash = parseFloat($('#cash').val()) || 0;
                var grandTotal = parseFloat($('#grandTotal').val()) || 0;
                var change = cash - grandTotal;

                if (change >= 0) {
                    // Process payment (you can add your logic here)
                    alert('Payment processed successfully!');
                } else {
                    alert('Insufficient cash amount!');
                }
            });

            // Add selected product to the table and update payment info
            $('#tambah_button').click(function() {
                // Your existing code to add product to the cart

                // Call calculateTotals to update payment info
                calculateTotals();
            });

            // Remove row when the "Hapus" button is clicked and update payment info
            $(document).on('click', '.hapus', function() {
                $(this).closest('tr').remove();
                // Call calculateTotals to update payment info
                calculateTotals();
            });
        });
    </script>
@endsection
