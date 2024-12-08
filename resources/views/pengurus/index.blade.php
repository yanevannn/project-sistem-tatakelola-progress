@extends('layout.layout')
@section('page-title', 'Data Pengurus UKM')

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="{{ route('user.index') }}" method="GET">
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
                    <a href="{{ route('user.create') }}" class="font-weight-bold text-xs text-white" data-toggle="tooltip"
                        data-original-title="tambah">Tambah Data</a>
                </button>
            </div>
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tabel Pengurus</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
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
                                        Email</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jabatan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Periode</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengurus as $p)
                                    <tr>
                                        <td class="text-xs align-middle text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $p->nama }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">{{ $p->nim }}</td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $p->email }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $p->role }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $p->periode->tahun }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($p->periode->status === 'aktif')
                                                <span class="badge badge-sm bg-success">{{ $p->periode->status }}</span>
                                            @else
                                                <span class="badge badge-sm bg-danger">{{ $p->periode->status }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-icon btn-2 btn-warning" type="button">
                                                <a href="{{ route('user.edit', $p->id) }}" class="text-white">
                                                    Edit</i>
                                                </a>
                                            </button>
                                            <button class="btn btn-icon btn-2 btn-danger" type="button">
                                                <a href="" class="text-white">
                                                    Hapus</i>
                                                </a>
                                            </button>
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
@endsection
