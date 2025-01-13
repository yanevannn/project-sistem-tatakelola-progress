@extends('layout.layout')
@section('page-title', 'Data Prestasi Anggota UKM')

@section('content')
    <div class="row mb-4">
        <div class="mb-lg-0 mb-4">
            <div class="col-lg-12">
                
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('prestasi_anggota.index') }}" method="GET">
                            <label for="periode">PERIODE</label>
                            <div class="form-group col-lg-2">
                                <select name="periode" class="form-control mb-4" required onchange="this.form.submit()">
                                    <option value="" disabled
                                        {{ !request('periode', auth()->user()->id_periode) ? 'selected' : '' }}>Pilih periode</option>
                                    @foreach ($periode as $p)
                                        <option value="{{ $p->id }}"
                                            {{ request('periode', auth()->user()->id_periode) == $p->id ? 'selected' : '' }}>
                                            {{ $p->tahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    @if(auth()->user()->isPengurus())
                        <div class="col-lg-4 d-flex justify-content-end align-items-end">
                            <button class="btn bg-gradient-success">
                                <a href="{{ route('prestasi_anggota.create') }}" class="font-weight-bold text-xs text-white" data-toggle="tooltip"
                                    data-original-title="tambah">Tambah Data</a>
                            </button>
                        </div>
                        @endif
                </div>
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header">
                            <div class="row">

                                    <h6>Tabel Prestasi Anggota UKM</h6>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="prestasiAnggotaTable">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama Anggota</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama Prestasi</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tingkat</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tahun Prestasi</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            File</th>
                                            @if(auth()->user()->isPengurus())
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="mb-0">
                                        @foreach ($prestasi as $p)
                                            <tr>
                                                <td class="text-center font-weight-bold text-xs mb-0">{{ $loop->iteration }}
                                                </td>
                                                <td class="text-center font-weight-bold text-xs mb-0">
                                                    {{ $p->anggota->nama }}</td>
                                                <!-- Assuming the relationship is defined -->
                                                <td class="text-center font-weight-bold text-xs mb-0">
                                                    {{ $p->nama_prestasi }}</td>
                                                <td class="text-center font-weight-bold text-xs mb-0">{{ $p->tingkat }}
                                                </td>
                                                <td class="text-center font-weight-bold text-xs mb-0">
                                                    {{ $p->tahun_prestasi }}</td>
                                                <td class="align-middle text-center">
                                                    <a href="{{ asset('dokumen/prestasi_anggota/' . $p->file) }}" target="_blank">
                                                        <img src="{{ asset('dokumen/prestasi_anggota/' . $p->file) }}" alt="Prestasi" class="img-fluid" style="max-width: 100%; height: 100px;">
                                                    </a>
                                                </td>
                                                @if(auth()->user()->isPengurus())
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('prestasi_anggota.edit', $p->id) }}"
                                                        class="font-weight-bold text-xs text-white btn btn-warning mb-0"
                                                        data-toggle="tooltip" data-original-title="Edit">EDIT</a>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        // Event handler untuk tombol delete
        document.querySelectorAll('.delete').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah submit form otomatis

                const form = this.closest('form'); // Ambil form terdekat dari tombol
                const dataName = this.getAttribute('data-name'); // Ambil nilai data-name dari atribut

                // SweetAlert dengan tombol konfirmasi dan pembatalan yang disesuaikan
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data ' + dataName + ' yang dihapus tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form jika dikonfirmasi
                    } else {
                        Swal.fire('Data Anda aman!', '',
                            'info'); // Tampilkan pesan jika dibatalkan
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#prestasiAnggotaTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
