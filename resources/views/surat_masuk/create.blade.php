@extends('layout.layout')
@section('page-title', 'Tambah Surat Masuk')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Tambah Surat Masuk</h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('suratmasuk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Token CSRF untuk keamanan Laravel -->
                        <div class="row">
                            <div class="form-group col-lg-6 mb-0">
                                <div class="form-group">
                                    <label for="no_surat_masuk">Nomor Surat</label>
                                    <input type="text" name="no_surat_masuk" class="form-control"
                                        placeholder="masukkan no surat" value="{{ old('no_surat_masuk') }}">
                                    @error('no_surat_masuk')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-6 mb-0">
                                <label for="periode">Periode</label>
                                <select name="periode" class="form-control " required>
                                    <option value="" disabled selected>Pilih Periode</option>
                                    @foreach ($periode as $p)
                                        <option value="{{ $p->id }}">{{ $p->tahun }}</option>
                                    @endforeach
                                </select>
                                @error('periode')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="penerima">Penerima</label>
                                <input type="text" name="penerima" class="form-control"
                                    placeholder="masukkan penerima surat" value="{{ old('penerima') }}"required>
                                    @error('penerima')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="pengirim">Pengirim</label>
                                <input type="text" name="pengirim" class="form-control"
                                    placeholder="masukkan pengirim surat" value="{{ old('pengirim') }}"required>
                                    @error('pengirim')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="tanggalmasuk">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" class="form-control"
                                    placeholder="masukkan tanggal masuk surat" value="{{ old('tanggal_masuk') }}"required>
                                    @error('tanggal_masuk')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tanggalkegiatan">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal_kegiatan" class="form-control"
                                    placeholder="masukkan tanggal kegiatan surat"
                                    value="{{ old('tanggal_kegiatan') }}"required>
                                    @error('tanggal_kegiatan')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="file">File Surat</label>
                                <input type="file" class="form-control" name="file">
                            <p class="text-secondary font-weight-bold text-xs mt-2"> Note : Maksimal ukuran file 2MB </p>
                                @error('file')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control"
                                    placeholder="masukkan keterangan surat" value="{{ old('keterangan') }}"required>
                                    @error('keterangan')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
