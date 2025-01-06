@extends('layout.layout')
@section('page-title', 'Keuangan')

@section('content')
    <div class="row ">
        <div class="col-lg-8">
            <form action="{{ route('keuangan.index') }}" method="GET">
                <div class="form-group col-lg-2">
                    <label for="periode">PERIODE</label>
                    <select name="periode" class="form-control mb-4" required onchange="this.form.submit()">
                        <option value="" disabled>Pilih periode</option>
                        @foreach ($periodes as $periode)
                            <option value="{{ $periode->id }}"
                                {{ request('periode', auth()->user()->id_periode) == $periode->id ? 'selected' : '' }}>
                                {{ $periode->tahun }}
                            </option>
                        @endforeach
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
            <h6>Tabel Keuangan UKM</h6>
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
                        @forelse ($keuangan as $k)
                            <tr>
                                <td class="text-xs align-middle text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0">
                                        {{ \Carbon\Carbon::parse($k->tanggal)->format('d-m-Y') }}</p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0">{{ $k->keterangan }}</p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0">
                                        {{ number_format($k->pemasukan, 0, ',', '.') }}</p>
                                </td>
                                <td>
                                    <p class="text-xs text-center font-weight-bold mb-0">
                                        {{ number_format($k->pengeluaran, 0, ',', '.') }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('keuangan.edit', $k->id) }}"
                                        class="font-weight-bold text-xs text-white btn btn-warning mb-0"
                                        data-toggle="tooltip" data-original-title="Edit">EDIT</a>
                                    {{-- <form action="" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mb-0 font-weight-bold text-xs delete"
                                            data-transaksi="{{ $k->keterangan }}" data-toggle="tooltip"
                                            data-original-title="Delete">
                                            Delete
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-sm font-weight-bold">Tidak ada data keuangan untuk periode ini</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-sm text-start text-uppercase font-weight-bold">Total</th>
                            <th class="text-center text-xs font-weight-bold">{{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                            <th class="text-center text-xs font-weight-bold">{{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-sm text-uppercase font-weight-bold">Saldo Akhir</th>
                            <th colspan="2" class="text-center text-xs font-weight-bold">Rp. {{ number_format($saldoAkhir, 0, ',', '.') }}</th>
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
                        text: "Data Transaski dari " + namabarang +
                            " yang dihapus tidak bisa dikembalikan!",
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
