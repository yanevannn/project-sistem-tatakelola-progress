@extends('layout.layout')
@section('page-title', 'Tambah Surat Keluar')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Tambah Surat Keluar</h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('suratkeluar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Token CSRF untuk keamanan Laravel -->
                        <div class="row">
                            <div class="form-group col-lg-6 mb-0">
                                <div class="form-group">
                                    <label for="nomor_surat_keluar">Nomor Surat</label>
                                    <input type="text" name="nomor_surat_keluar" class="form-control"
                                        placeholder="masukkan no surat" value="{{ old('nomor_surat_keluar') }}">
                                    @error('nomor_surat_keluar')
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
                                <label for="tertuju">Tertuju</label>
                                <input type="text" name="tertuju" class="form-control"
                                    placeholder="masukkan penerima surat" value="{{ old('tertuju') }}"required>
                                    @error('tertuju')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control"
                                    placeholder="masukkan keterangan" value="{{ old('keterangan') }}"required>
                                    @error('keterangan')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="tanggalmasuk">Tanggal Surat</label>
                                <input type="date" name="tanggal_surat" class="form-control"
                                    placeholder="masukkan tanggal surat" value="{{ old('tanggal_surat') }}"required>
                                    @error('tanggalsurat')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tanggal_terkirim">Tanggal Terkirim</label>
                                <input type="date" name="tanggal_terkirim" class="form-control"
                                    placeholder="masukkan tanggal terkirim surat"
                                    value="{{ old('tanggal_terkirim') }}"required>
                                    @error('tanggal_terkirim')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="file">File Surat</label>
                                <input type="file" class="form-control" name="file">
                                @error('file')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
