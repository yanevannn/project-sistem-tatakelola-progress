@extends('layout.layout')
@section('page-title', 'Data Anggota UKM')

@section('content')
    <div class="row mb-4">
        <div class="mb-lg-0 mb-4">
            <div class="col-lg-12">
                @if(auth()->user()->isPengurus())
                <button class="btn bg-gradient-success">
                    <a href="{{ route('prestasi_anggota.create') }}" class="font-weight-bold text-xs text-white" data-toggle="tooltip"
                        data-original-title="Tambah prestasi">Tambah Data</a>
                </button>
                @endif
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6>Tabel Prestasi Anggota UKM</h6>
                                </div>
                                <div class="col-lg-3">
                                    <form action="{{ route('prestasi_anggota.index') }}" method="GET" class="d-flex">
                                        <input type="text" value="{{ request('search') }}" class="form-control"
                                            name="search" placeholder="Kata kunci ..." aria-label="Kata kunci ...">
                                        <button class="btn shadow-none mb-0 btn-outline-dark mx-1" type="submit"
                                            id="button-addon2">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
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
                                            Keterangan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            File</th>
                                            @if(auth()->user()->isPengurus())
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                        <th class="text-secondary opacity-7"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="mb-0">
                                    @if ($prestasi->isEmpty())
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <p class="text-xs font-weight-bold mb-0 mt-4">Tidak ada data prestasi.</p>
                                            </td>
                                        </tr>
                                    @else
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
                                                <td class="text-center font-weight-bold text-xs mb-0">{{ $p->keterangan }}
                                                </td>
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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="px-3">
                        {{ $prestasi->links() }}
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
@endsection
