@extends('layout.layout')
@section('page-title', 'Data Anggota UKM')

@section('content')
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Edit Data Anggota</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token CSRF untuk keamanan Laravel -->
                    @method('PUT')
                    <div class="form-group col-lg-6">
                        <label for="status">Periode</label>
                        <select name="periode" class="form-control " required>
                            <option value="{{ $anggota->id_periode }}" selected>
                                {{ $anggota->periode->tahun }}</option>
                            @foreach ($periode as $p)
                                <option value="{{ $p->id }}">{{ $p->tahun }}</option>
                            @endforeach
                        </select>
                        @error('periode')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" class="form-control"
                            placeholder="nim anggota" value="{{ $anggota->nim }}"required>
                            @error('nim')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control"
                            placeholder="nama anggota" value="{{ $anggota->nama }}"required>
                            @error('nama')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="email">Nama</label>
                        <input type="email" name="nama" class="form-control"
                            placeholder="nama anggota" value="{{ $anggota->email }}"required>
                            @error('email')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                            @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
