@extends('layout.layout')
@section('page-title', 'Data Dokumen Event')

@section('content')
    <div class="row mb-4">
        <div class=" mb-lg-0 mb-4">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('dokumen_event.index') }}" method="GET">
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
                        <div class="col-lg-4 d-flex justify-content-end align-items-end">
                            <button class="btn bg-gradient-success">
                                <a href="{{ route('dokumen_event.create') }}" class="font-weight-bold text-xs text-white" data-toggle="tooltip"
                                    data-original-title="tambah">Tambah Data</a>
                            </button>
                        </div>
                </div>
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6>Tabel Dokumen Event UKM</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="dokumeneventTable">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama Kegiatan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Mulai</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Selesai</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Proposal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            LPJ</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            LPJK</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ( $dokumen_event as $d )
                                        <tr>
                                            <td class="text-center text-xs font-weight-bold">{{ $loop->iteration }}</td>
                                            <td class="text-xs font-weight-bold text-center">{{ $d->nama_kegiatan }}</td>
                                            <td class="text-xs font-weight-bold text-center">{{ $d->tanggal_mulai }}</td>
                                            <td class="text-xs font-weight-bold text-center">{{ $d->tanggal_selesai }}</td>
                                            <td class="text-xs font-weight-bold text-center">
                                                @if ($d->proposal)
                                                    <a href="{{ asset('dokumen/kegiatan/proposal/' . $d->proposal) }}" target="_blank"
                                                        class="btn btn-sm btn-primary mb-0">Lihat</a>
                                                @else
                                                    <span class="text-danger">Tidak Ada</span>
                                                @endif
                                            </td>
                                            <td class="text-xs font-weight-bold text-center">
                                                @if ($d->lpj)
                                                    <a href="{{ asset('dokumen/kegiatan/lpj/' . $d->lpj) }}" target="_blank"
                                                        class="btn btn-sm btn-primary mb-0">Lihat</a>
                                                @else
                                                    <span class="text-danger">Tidak Ada</span>
                                                @endif
                                            </td>
                                            <td class="text-xs font-weight-bold text-center">
                                                @if ($d->lpjk)
                                                    <a href="{{ asset('dokumen/kegiatan/lpjk/' . $d->lpjk) }}" target="_blank"
                                                        class="btn btn-sm btn-primary mb-0">Lihat</a>
                                                @else
                                                    <span class="text-danger">Tidak Ada</span>
                                                @endif
                                            </td>
                                            <td class="text-xs text-center font-weight-bold">
                                                @if ($d->keterangan == 'Selesai')
                                                    <span class="badge badge-sm bg-success">{{ $d->keterangan }}</span>
                                                @elseif ($d->keterangan == 'Ditunda')
                                                    <span class="badge badge-sm bg-warning">{{ $d->keterangan }}</span>
                                                @elseif ($d->keterangan == 'Dibatalkan')
                                                    <span class="badge badge-sm bg-danger">{{ $d->keterangan }}</span>
                                                @else
                                                    <span class="badge badge-sm bg-primary">{{ $d->keterangan }}</span>
                                                @endif

                                            </td>
                                            <td class="text-xs font-weight-bold text-center">
                                                <a href="{{ route('dokumen_event.edit', $d->id) }}"
                                                    class="btn btn-sm btn-warning mb-0">Edit</a>
                                                <form action="{{ route('dokumen_event.destroy', $d->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger mb-0 delete" data-event="{{ $d->nama_kegiatan }}">Hapus</button>
                                                </form>
                                            </td>
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
            const dataevent = this.getAttribute(
                'data-event'); // Ambil nilai periode dari atribut data-periode

            swal({
                    title: "Apakah Anda yakin?",
                    text: "Data Event " + dataevent + " yang dihapus tidak bisa dikembalikan!",
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
<script>
    $(document).ready(function() {
        $('#dokumeneventTable').DataTable({
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