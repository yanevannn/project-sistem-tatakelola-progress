@extends('layout.layout')
@section('page-title', 'Perbarui Data Keuangan')

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
                            <option value="baik" selected>2021</option>
                            <option value="rusak">2022</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="periode">Jenis Transaksi</label>
                        <select name="periode" class="form-control mb-4" required>
                            <option value="pemasukan" selected>pemasukan</option>
                            <option value="pengeluran">pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="periode">Tanggal Transaksi</label>
                        <input type="date" name="tgl_transaksi" class="form-control" value="2024-10-29"required>
                    </div>

                    <div class="form-group ">
                        <label for="periode">Jumlah Transaksi</label>
                        <input type="number" name="jumlah_transaksi" class="form-control"
                            placeholder="masukkan jumlah transaksi" value="100.000"required>
                    </div>
                    <div class="form-group">
                        <label for="periode">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control"
                            placeholder="masukkan keterangan transaksi" value="Iuran Bulanan"required>
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
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
