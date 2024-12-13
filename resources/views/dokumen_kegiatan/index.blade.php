@extends('layout.layout')
@section('page-title', 'Dokumen Kegiatan UKM')

@section('content')
    <div class="row mb-4">
        <div class=" mb-lg-0 mb-4">
            <div class="col-lg-12">
                <button class="btn bg-gradient-success">
                    <a href="{{ route('dokumen_kegiatan.create') }}" class="font-weight-bold text-xs text-white"
                        data-toggle="tooltip">Tambah Data</a>
                </button>
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6>Tabel Dokumen Kegiatan UKM</h6>
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
                                    @forelse ($dokumen_kegiatan as $d)
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
                                                <a href="{{ route('dokumen_kegiatan.edit', $d->id) }}"
                                                    class="btn btn-sm btn-warning mb-0">Edit</a>
                                                <form action="{{ route('dokumen_kegiatan.destroy', $d->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger mb-0">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <p class="text-xs font-weight-bold mb-0 mt-4">Tidak ada dokumen.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="px-3">
                        {{ $dokumen_kegiatan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
