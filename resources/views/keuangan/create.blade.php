@extends('layout.layout')
@section('page-title', 'Tambah Data Keuangan')

@section('content')
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Tambah Data Transaksi</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('index.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token CSRF untuk keamanan Laravel -->
                    <div class="form-group">
                        <label for="periode">Periode</label>
                        <select name="periode" class="form-control mb-4" required>
                            <option value="" disabled selected>Pilih periode</option>
                            <option value="2021" {{ old('periode') == '2021' ? 'selected' : '' }}>2021</option>
                            <option value="2022" {{ old('periode') == '2022' ? 'selected' : '' }}>2022</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jensi_transaksi">Jenis Transaksi</label>
                        <select name="jenis_transaksi" class="form-control mb-4" required>
                            <option value="" disabled selected>Pilih Transaksi</option>
                            <option value="pemasukan" {{ old('jenis_transaksi') == 'pemasukan' ? 'selected' : '' }}>pemasukan</option>
                            <option value="pengeluaran" {{ old('jenis_transaksi') == 'pengeluaran' ? 'selected' : '' }}>pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="periode">Tanggal Transaksi</label>
                        <input type="date" name="tgl_transaksi" class="form-control" value="{{ old('tgl_transaksi') }}"required>
                    </div>

                    <div class="form-group ">
                        <label for="periode">Jumlah Transaksi</label>
                        <input type="number" name="jumlah_transaksi" class="form-control"
                            placeholder="masukkan jumlah transaksi" value="{{ old('jumlah_transaksi') }}"required>
                    </div>
                    <div class="form-group">
                        <label for="periode">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control"
                            placeholder="masukkan keterangan transaksi" value="{{ old('keterangan') }}"required>
                    </div>

                    {{-- <div class="form-group">
                        <label for="foto">Foto Inventaris</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        @error('foto')
                            <div class="text-danger">{{ $message }}</div> <!-- Menampilkan pesan kesalahan -->
                        @enderror
                    </div> --}}
                    <div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
