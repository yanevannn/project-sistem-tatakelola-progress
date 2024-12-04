@extends('layout.layout')
@section('page-title', 'Perbarui Surat Masuk')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Perbarui Surat Masuk</h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('suratmasuk.update', $suratmasuk->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf <!-- Token CSRF untuk keamanan Laravel -->
                        @method('PUT')
                        <div class="row coll-lg 12">
                            <div class="form-group col-lg-6">
                                <label for="periode">Nomor Surat</label>
                                <input type="text" name="nomor_surat_masuk" class="form-control"
                                    placeholder="masukkan no surat" value="{{ $suratmasuk->nomor_surat_masuk }}"required>
                                @error('nomor_surat_masuk')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="id_periode">Periode</label>
                                <select name="id_periode" class="form-control " required>
                                    <option value="{{ $suratmasuk->id_periode }}">{{ $suratmasuk->periode->tahun }}</option>
                                    @foreach ($periode as $pd)
                                        <option value="{{ $pd->id }}">{{ $pd->tahun }}</option>
                                    @endforeach
                                </select>
                                @error('id_periode')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="periode">Penerima</label>
                                <input type="text" name="penerima" class="form-control"
                                    placeholder="masukkan penerima surat" value="{{ $suratmasuk->penerima }}"required>
                                    @error('penerima')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="periode">Pengirim</label>
                                <input type="text" name="pengirim" class="form-control"
                                    placeholder="masukkan pengirim surat" value="{{ $suratmasuk->pengirim }}"required>
                                    @error('pengirim')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="periode">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal_surat" class="form-control"
                                    placeholder="masukkan tanggal masuk surat"
                                    value="{{ $suratmasuk->tanggal_surat }}"required>
                                    @error('tanggal_surat')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="periode">Tanggal Masuk</label>
                                <input type="date" name="tanggal_terima" class="form-control"
                                    placeholder="masukkan tanggal kegiatan surat"
                                    value="{{ $suratmasuk->tanggal_terima }}"required>
                                    @error('tanggal_terima')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="foto">File Surat</label>
                                <input type="file" class="form-control" name="file" id="fileInput">

                                <!-- Menampilkan nama file yang tersimpan -->
                                @if (!empty($suratmasuk->file))
                                    <p class="text-secondary font-weight-bold text-xs mt-2" id="fileName">
                                        File saat ini: {{ $suratmasuk->file }}
                                    </p>
                                @else
                                    <p class="text-secondary font-weight-bold text-xs mt-2" id="fileName">
                                        Belum ada file yang diunggah
                                    </p>
                                @endif

                                <p class="text-secondary font-weight-bold text-xs mt-2">Note: Maksimal ukuran file 2MB</p>

                                @error('file')
                                    <div class="text-danger">{{ $message }}</div> <!-- Menampilkan pesan kesalahan -->
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control"
                                    placeholder="masukkan keterangan surat" value="{{ $suratmasuk->keterangan }}"required>
                                    @error('keterangan')
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
