@extends('layout.layout')
@section('page-title', 'Surat Keluar')

@section('content')
    <div class="row mb-4">
        <div class=" mb-lg-0 mb-4">
            <div class="col-lg-12">
                <button class="btn bg-gradient-success">
                    <a href="{{ route('suratkeluar.create') }}" class="font-weight-bold text-xs text-white"
                        data-toggle="tooltip" data-original-title="Edit user">Tambah Data</a>
                </button>
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6>Tabel Surat Keluar</h6>
                                </div>
                                <div class="col-lg-3">
                                    <form action="{{ route('suratkeluar.index') }}" method="POST" class="d-flex">
                                        <input type="text" value="{{ request('search') }}" class="form-control"
                                            name="search" placeholder="Kata kunci ..."aria-label="Kata kunci ...">
                                        <button class="btn shadow-none mb-0 btn-outline-dark mx-1" type="submit"
                                            id="button-addon2">
                                            <i class="fa fa-search"></i>
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
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                            Periode</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor Surat Masuk</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tertuju</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Surat</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Terkirim</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Keterangan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            File Dokumen</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody class="mb-0">
                                    @if ($suratkeluar->isEmpty())
                                        <tr>
                                            <td colspan="12" class="text-center">
                                                <p class="text-xs font-weight-bold mb-0 mt-4">Tidak ada data surat keluar.
                                                </p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($suratkeluar as $sk)
                                            <tr>
                                                <td class="text-center font-weight-bold text-xs mb-0">{{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sk->periode->tahun }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sk->nomor_surat_keluar }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sk->tertuju }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sk->tanggal_surat }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sk->tanggal_terkirim }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $sk->keterangan }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <button type="button" class="btn btn-secondary mb-0">
                                                        <a href="{{ asset('dokumen/suratkeluar/' . $sk->file) }}" download="{{ $sk->file }}" class="text-white">
                                                            Download
                                                        </a>
                                                    </button>
                                                </td>
                                                
                                                <td class="align-middle text-center m-0">
                                                    <a href="{{ route('suratkeluar.edit', $sk->id) }}"
                                                        class="font-weight-bold text-xs text-white btn btn-warning mb-0"
                                                        data-toggle="tooltip" data-original-title="Edit">EDIT</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="px-3">
                        {{ $suratkeluar->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
