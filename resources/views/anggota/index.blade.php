@extends('layout.layout')
@section('page-title', 'Data Anggota UKM')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form-group col-lg-2">
                <label for="periode">PERIODE</label>
                <select name="periode" class="form-control mb-4" required onchange="this.form.submit()">
                    <option value="" disabled>Pilih periode</option>
                    @foreach ($periode as $p)
                        <option value="{{ $p->id }}"
                            {{ request('periode', auth()->user()->id_periode) == $p->id ? 'selected' : '' }}>
                            {{ $p->tahun }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-9">
                            <h6>Tabel Anggota</h6>
                        </div>
                        <div class="col-lg-3">
                            <form action="{{ route('anggota.index') }}" method="GET" class="d-flex">
                                <input type="text" value="{{ request('search') }}" class="form-control"
                                    name="search" placeholder="Kata kunci ..."aria-label="Kata kunci ...">
                                <button class="btn shadow-none mb-0 btn-outline-dark mx-1" type="submit"
                                    id="button-addon2">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
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
                                        No Whatsapp</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kelas</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Aksi</th>
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
                                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <p class="text-xs text-center font-weight-bold mb-0">{{ $a->nama }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $a->nim }}</td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $a->email }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $a->no_hp }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $a->kelas }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn btn-icon btn-2 btn-info" type="button">
                                                    <a href="" class="text-white">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-icon btn-2 btn-warning" type="button">
                                                    <a href="{{ route('anggota.edit',$a->id) }}" class="text-white">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-icon btn-2 btn-danger" type="button">
                                                    <a href="" class="text-white">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </button>
                                            </td>
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
    <button class="btn bg-gradient-success">
        <a href="{{ route('anggota.create') }}" class="font-weight-bold text-xs text-white" data-toggle="tooltip"
            data-original-title="tambah">Tambah Data</a>
    </button>
@endsection
