@extends('layout.layout')
@section('page-title', 'Dokumen UKM')

@section('content')
    <div class="row mb-4">
        <div class=" mb-lg-0 mb-4">
            <div class="col-lg-12">
                <button class="btn bg-gradient-success">
                    <a href="{{ route('dokumen_ukm.create') }}" class="font-weight-bold text-xs text-white"
                        data-toggle="tooltip" data-original-title="Edit user">Tambah Data</a>
                </button>
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6>Tabel Dokumen UKM</h6>
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
                                            Nama Ketua</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            RKA</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            AD/ART</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            STATUS</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody class="mb-0">
                                    @if ($dokumen_ukm->isEmpty())
                                        <tr>
                                            <td colspan="12" class="text-center">
                                                <p class="text-xs font-weight-bold mb-0 mt-4">Tidak ada dokumen UKM saat ini.
                                                </p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($dokumen_ukm as $dokumen)
                                            <tr>
                                                <td class="text-center font-weight-bold text-xs mb-0">{{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $dokumen->periode->tahun }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-center font-weight-bold mb-0">
                                                        {{ $dokumen->nama_ketua }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('dokumen_ukm.view', ['type' => 'rka', 'id' => $dokumen->id]) }}" 
                                                        class="btn btn-info btn-sm text-center">
                                                         Lihat RKA
                                                     </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('dokumen_ukm.view', ['type' => 'adart', 'id' => $dokumen->id]) }}" 
                                                        class="btn btn-info btn-sm text-center">
                                                         Lihat ADART
                                                     </a>
                                                </td>
                                                <td class="align-middle text-center text-sm" >
                                                    @if ($dokumen->periode->status === 'aktif')
                                                    <span class="badge badge-sm bg-success">{{ $dokumen->periode->status }}</span>
                                                @else
                                                    <span class="badge badge-sm bg-danger">{{ $dokumen->periode->status }}</span>
                                                @endif
                                                </td>
                                                <td class="align-middle text-center m-0">
                                                    <a href="{{ route('dokumen_ukm.edit', $dokumen->id) }}"
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
                        {{ $dokumen_ukm->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
