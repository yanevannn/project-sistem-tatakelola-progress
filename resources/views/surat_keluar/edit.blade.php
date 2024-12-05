@extends('layout.layout')
@section('page-title', 'Perbarui Surat Keluar')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Perbarui Surat Keluar</h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('suratkeluar.update', $suratkeluar->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf <!-- Token CSRF untuk keamanan Laravel -->
                        @method('PUT')
                        <div class="row coll-lg 12">
                            <div class="form-group col-lg-6">
                                <label for="status">Periode</label>
                                <select name="periode" class="form-control " required>
                                    <option value="{{ $suratkeluar->id_periode }}" selected>
                                        {{ $suratkeluar->periode->tahun }}</option>
                                    @foreach ($periode as $p)
                                        <option value="{{ $p->id }}">{{ $p->tahun }}</option>
                                    @endforeach
                                </select>
                                @error('periode')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="nomor_surat_keluar">Nomor Surat</label>
                                <input type="text" name="nomor_surat_keluar" class="form-control"
                                    placeholder="masukkan no surat" value="{{ $suratkeluar->nomor_surat_keluar }}"required>
                                    @error('nomor_surat_keluar')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="tertuju">Tertuju</label>
                                <input type="text" name="tertuju" class="form-control"
                                    placeholder="masukkan penerima surat" value="{{ $suratkeluar->tertuju }}"required>
                                    @error('tertuju')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control"
                                    placeholder="masukkan pengirim surat" value="{{ $suratkeluar->keterangan }}"required>
                                    @error('keterangan')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="tanggal_surat">Tanggal Surat</label>
                                <input type="date" name="tanggal_surat" class="form-control"
                                    placeholder="masukkan tanggal masuk surat"
                                    value="{{ $suratkeluar->tanggal_surat }}"required>
                                    @error('tanggal_surat')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tanggal_terkirim">Tanggal Dikirim</label>
                                <input type="date" name="tanggal_terkirim" class="form-control"
                                    placeholder="masukkan tanggal dikirim surat"
                                    value="{{ $suratkeluar->tanggal_terkirim }}"required>
                                    @error('tanggal_terkirim')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">File Surat</label>
                            <input type="file" class="form-control" name="file" value="{{ $suratkeluar->file }}">
                            <p class="text-secondary font-weight-bold text-xs mt-2"> Note : Maksimal ukuran file 2MB </p>
                            @error('file')
                                <div class="text-danger">{{ $message }}</div> <!-- Menampilkan pesan kesalahan -->
                            @enderror
                        </div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">PERBARUI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
