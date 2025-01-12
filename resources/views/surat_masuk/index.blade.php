@extends('layout.layout')
@section('page-title', 'Surat Masuk')

@section('content')
    <div class="row mb-4">
        <div class=" mb-lg-0 mb-4">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('suratmasuk.index') }}" method="GET">
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
                                <a href="{{ route('suratmasuk.create') }}" class="font-weight-bold text-xs text-white" data-toggle="tooltip"
                                    data-original-title="tambah">Tambah Data</a>
                            </button>
                        </div>
                </div>
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6>Tabel Surat Masuk UKM</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="suratMasukTable">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                            Periode</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor Surat Masuk</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Penerima</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Pengirim</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Masuk</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Terima</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Keterangan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            File Dokumen</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="mb-0">
                                        @foreach ($suratmasuk as $sm)
                                            <tr>
                                                <td class="text-center font-weight-bold text-xs mb-0">{{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sm->periode->tahun }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sm->nomor_surat_masuk }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sm->penerima }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sm->pengirim }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sm->tanggal_surat }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sm->tanggal_terima }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">{{ $sm->keterangan }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    
                                                        <a href="{{ asset('dokumen/suratmasuk/' . $sm->file) }}" target="_blank"
                                                            class="btn btn-sm btn-primary mb-0">Lihat</a>
                                                </td>
                                                <td class="align-middle text-center m-0">
                                                        <a href="{{ route('suratmasuk.edit', $sm->id) }}"
                                                            class="font-weight-bold text-xs text-white btn btn-warning mb-0"
                                                            data-toggle="tooltip" data-original-title="Edit">EDIT</a>
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
    $(document).ready(function() {
        $('#suratMasukTable').DataTable({
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
