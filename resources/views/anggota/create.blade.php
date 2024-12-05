@extends('layout.layout')
@section('page-title', 'Data Anggota UKM')

@section('content')
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Tambah Data Anggota</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token CSRF untuk keamanan Laravel -->
                    <div class="form-group">
                        <label for="periode">Periode</label>
                        <select name="periode" class="form-control mb-4" required>
                            <option value="" disabled selected>Pilih periode</option>
                            @foreach ($periode as $p)
                                <option value="{{ $p->id }}">{{ $p->tahun }}</option>
                            @endforeach
                            @error('periode')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div> <!-- Menampilkan pesan kesalahan -->
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="csv_file">Pilih file CSV untuk di-upload:</label>
                        <input type="file" name="csv_file" class="form-control" required>
                        <p class="text-secondary font-weight-bold text-xs mt-2"> Note : Maksimal ukuran file 2MB </p>
                        @error('csv_file')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                            <!-- Menampilkan pesan kesalahan -->
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
