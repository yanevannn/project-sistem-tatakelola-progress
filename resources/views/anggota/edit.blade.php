@extends('layout.layout')
@section('page-title', 'Data Anggota UKM')

@section('content')
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Edit Data Anggota</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token CSRF untuk keamanan Laravel -->
                    @method('PUT')
                    <div class="form-group col-lg-6">
                        <label for="status">Periode</label>
                        <select name="periode" class="form-control " disabled>
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
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control"
                            placeholder="email anggota" value="{{ $anggota->email }}"required>
                            @error('email')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="kelas">Kelas</label>
                        <input type="text" name="kelas" class="form-control"
                            placeholder="Kelas anggota" value="{{ $anggota->kelas }}"required>
                            @error('kelas')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="no_hp">Nomor Handphone</label>
                        <input type="text" name="no_hp" class="form-control"
                            placeholder="nomor telephone" value="{{ $anggota->no_hp }}"required>
                            @error('no_hp')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                            @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
