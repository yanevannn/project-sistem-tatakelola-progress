@extends('layout.layout')
@section('page-title', 'Keuangan')

@section('content')
<div class="row ">
    <div class="col-lg-8">
        <form action="">
            <div class="form-group col-lg-2">
                <label for="periode">PERIODE</label>
                <select name="periode" class="form-control mb-4" required>
                    <option value="" disabled selected>Pilih periode</option>
                    <option value="baik">2021</option>
                    <option value="rusak">2022</option>
                </select>
            </div>
        </form>
    </div>
    <div class="col-lg-4 d-flex justify-content-end align-items-end">
        <button class="btn bg-gradient-success">
            <a href="{{ route('keuangan.create') }}" class="font-weight-bold text-xs text-white" data-toggle="tooltip"
                data-original-title="Edit user">Tambah Transaksi</a>
        </button>
    </div>
</div>
    <div class="card p-3">
        <div class="card-header pb-0">
            <h6>Tabel Inventaris</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center testext-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                No
                            </th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Tanggal Transaksi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Keterangan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Pemasukan (Rp) </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Pengeluaran (Rp)</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-xs align-middle text-center">1</td>
                            <td>
                                <p class="text-xs text-center font-weight-bold mb-0">01-01-2022</p>
                            </td>
                            <td>
                                <p class="text-xs text-center font-weight-bold mb-0">Iuran Bulanan</p>
                            </td>
                            <td>
                                <p class="text-xs text-center font-weight-bold mb-0">100.000</p>
                            </td>
                            <td>
                                <p class="text-xs text-center font-weight-bold mb-0">0</p>
                            </td>
                            <td class="align-middle text-center">

                                <a href="" class="font-weight-bold text-xs text-white btn btn-warning mb-0"
                                    data-toggle="tooltip" data-original-title="Edit">EDIT</a>

                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mb-0 font-weight-bold text-xs delete "
                                        data-transaksi="iuaran" data-toggle="tooltip" data-original-title="Delete">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-sm text-start text-uppercase font-weight-bold">Total</th>
                            <th class="text-center text-xs font-weight-bold">100.000</th>
                            <th class="text-center text-xs font-weight-bold">0</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-sm text-uppercase font-weight-bold">Saldo Akhir</th>
                            <th colspan="2" class="text-center text-xs font-weight-bold">Rp. 100.000</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Event Handler Delete -->
    <script>
        document.querySelectorAll('.delete').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah submit form otomatis

                const form = this.closest('form'); // Ambil form terdekat dari tombol
                const namabarang = this.getAttribute(
                    'data-transaksi'); // Ambil nilai periode dari atribut data-barang

                swal({
                        title: "Apakah Anda yakin?",
                        text: "Data Transaski dari " + namabarang + " yang dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit(); // Jika konfirmasi delete, submit form
                        } else {
                            swal("Data Anda aman!"); // Jika batal, tampilkan pesan
                        }
                    });
            });
        });
    </script>
    <!-- End Event Handler Delete -->
@endsection
