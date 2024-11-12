@extends('layout.layout')
@section('page-title', 'Tambah Data Keuangan')

@section('content')
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Tambah Data Transaksi</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('keuangan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token CSRF untuk keamanan Laravel -->
                    <div class="form-group">
                        <label for="periode">Periode</label>
                        <select name="periode" class="form-control mb-4" required>
                            <option value="" disabled selected>Pilih periode</option>
                            @foreach ($periode as $p ) 
                            <option value="{{ $p->id}}">{{ $p->tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenistransaksi">Jenis Transaksi</label>
                        <select name="jenistransaksi" class="form-control mb-4" required>
                            <option value="" disabled selected>Pilih Transaksi</option>
                            <option value="pemasukan">pemasukan</option>
                            <option value="pengeluaran">pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Transaksi</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}"required>
                    </div>

                    <div class="form-group ">
                        <label for="jumlah_transaksi">Jumlah Transaksi</label>
                        <input type="number" name="jumlah_transaksi" class="form-control"
                            placeholder="masukkan jumlah transaksi" value="{{ old('jumlah_transaksi') }}"required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control"
                            placeholder="masukkan keterangan transaksi" value="{{ old('keterangan') }}"required>
                    </div>
                    <div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
