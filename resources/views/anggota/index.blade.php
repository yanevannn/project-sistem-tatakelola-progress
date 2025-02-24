@extends('layout.layout')
@section('page-title', 'Data Anggota UKM')

@section('content')
    <div class="row mb-4">
        <div class="mb-lg-0 mb-4">

        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-8">
                    <form action="{{ route('anggota.index') }}" method="GET">
                        <label for="periode">PERIODE</label>
                        <div class="form-group col-lg-2">
                            <select name="periode" class="form-control mb-4" required onchange="this.form.submit()">
                                <option value="" disabled
                                    {{ !request('periode', auth()->user()->id_periode) ? 'selected' : '' }}>Pilih periode
                                </option>
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
                <div class="col-lg-4 d-flex justify-content-end align-items-end">
                    @if(auth()->user()->isPengurus())
                    <button class="btn bg-gradient-success">
                        <a href="{{ route('anggota.create') }}" class="font-weight-bold text-xs text-white"
                            data-toggle="tooltip" data-original-title="tambah">Tambah Data</a>
                    </button>
                    @endif
                </div>
            </div>
            <div class="card p-3">
                <div class="container-fluid px-0">
                    <div class="card-header pb-0">
                        <h6 class="mb-0">Tabel Anggota UKM</h6>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="anggotaTable">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nim</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No Whatsapp</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kelas</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status Keanggotaan</th>
                                    @if (auth()->user()->isPengurus())
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                            Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($anggota->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <p class="text-xs font-weight-bold my-4">Tidak ada data Anggota.</p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($anggota as $a)
                                        <tr>
                                            <td class="text-center font-weight-bold text-xs mb-0">{{ $loop->iteration }}
                                            </td>
                                            <td class="text-center font-weight-bold text-xs mb-0">{{ $a->nama }}</td>
                                            <td class="text-center font-weight-bold text-xs mb-0">{{ $a->nim }}</td>
                                            <td class="text-center font-weight-bold text-xs mb-0">{{ $a->no_hp }}</td>
                                            <td class="text-center font-weight-bold text-xs mb-0">{{ $a->kelas }}</td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($a->status_keanggotaan === 'aktif')
                                                    <span
                                                        class="badge badge-sm bg-success">{{ $a->status_keanggotaan }}</span>
                                                @elseif ($a->status_keanggotaan === 'lulus')
                                                    <span
                                                        class="badge badge-sm bg-warning">{{ $a->status_keanggotaan }}</span>
                                                @elseif ($a->status_keanggotaan === 'drop out')
                                                    <span
                                                        class="badge badge-sm bg-danger">{{ $a->status_keanggotaan }}</span>
                                                @endif
                                            </td>
                                            @if (auth()->user()->isPengurus())
                                                <td class="align-middle text-center">
                                                    <button class="btn btn-icon btn-warning" type="button">
                                                        <a href="{{ route('anggota.edit', $a->id) }}" class="text-white">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </button>
                                                    <form action="{{ route('anggota.destroy', $a->id) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger font-weight-bold text-xs delete "
                                                            data-name="{{ $a->nama }}" data-toggle="tooltip"
                                                            data-original-title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if (auth()->user()->isPengurus())
        <button class="btn bg-gradient-success">
            <a href="{{ route('anggota.create') }}" class="font-weight-bold text-xs text-white" data-toggle="tooltip"
                data-original-title="Tambah Data">Tambah Data</a>
        </button>
    @endif
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
            $('#anggotaTable').DataTable({
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
