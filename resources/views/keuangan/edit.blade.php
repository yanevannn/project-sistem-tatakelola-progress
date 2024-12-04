@extends('layout.layout')
@section('page-title', 'Perbarui Data Keuangan')

@section('content')
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Tambah Data Transaksi</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('keuangan.update', $keuangan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token CSRF untuk keamanan Laravel -->
                    @method('PUT')
                    <div class="form-group">
                        <label for="periode">Periode</label>
                        <select name="periode" class="form-control mb-4" required>
                            <option value="{{ $keuangan->id_periode }}" selected>{{ $keuangan->periode->tahun }}</option>
                            @foreach ($periode as $p)
                                <option value="{{ $p->id }}">{{ $p->tahun }}</option>
                            @endforeach
                        </select>
                        @error('periode')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenistransaksi">Jenis Transaksi</label>
                        <select name="jenistransaksi" class="form-control mb-4" required>
                            <option value="pemasukan"
                                {{ $keuangan->pemasukan != 0 && $keuangan->pengeluaran == 0 ? 'selected' : '' }}>Pemasukan
                            </option>
                            <option value="pengeluaran"
                                {{ $keuangan->pengeluaran != 0 && $keuangan->pemasukan == 0 ? 'selected' : '' }}>Pengeluaran
                            </option>
                        </select>
                        @error('jenistransaksi')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Transaksi</label>
                        <input type="date" name="tanggal" class="form-control"
                            value="{{ old('tanggal') ?? $keuangan->tanggal }}"required>
                        @error('tanggal')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <label for="jumlah_transaksi">Jumlah Transaksi</label>
                        <input type="number" name="jumlah_transaksi" class="form-control"
                            placeholder="masukkan jumlah transaksi"
                            value="{{ old('jumlah_transaksi') ?? number_format($keuangan->pemasukan != 0 ? $keuangan->pemasukan : $keuangan->pengeluaran, 0, '', '') }}"required>
                        @error('jumlah_transaksi')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control"
                            placeholder="masukkan keterangan transaksi"
                            value="{{ old('keterangan') ?? $keuangan->keterangan }}"required>
                        @error('keterangan')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
