@extends('layout.layout')
@section('page-title', 'Edit Dokumen Kegiatan')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Tambah Dokumen Kegiatan UKM</h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('dokumen_kegiatan.update',$dokumen_kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Token CSRF untuk keamanan Laravel -->
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-lg-6 mb-0">
                                <div class="form-group">
                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                    <input type="text" name="nama_kegiatan" class="form-control"
                                        placeholder="masukkan nama kegiatan" value="{{ old('nama_kegiatan', $dokumen_kegiatan->nama_kegiatan) }}">
                                    @error('nama_kegiatan')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-6 mb-0">
                                <label for="periode">Periode</label>
                                <select name="periode" class="form-control" required>
                                    <option value="" disabled selected>Pilih Periode</option>
                                    @foreach ($periode as $p)
                                        <option value="{{ $p->id }}" {{ old('periode', $dokumen_kegiatan->id_periode) == $p->id ? 'selected' : '' }}>
                                            {{ $p->tahun }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('periode')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>                           
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai', $dokumen_kegiatan->tanggal_mulai) }}">        
                                @error('tanggal_mulai')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="tanggal_selesai" value="{{ old('tanggal_selesai', $dokumen_kegiatan->tanggal_selesai) }}">
                                @error('tanggal_selesai')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="keterangan">Keterangan</label>
                                <select class="form-control" name="keterangan" id="keterangan">
                                    <option value="Sedang Proses" {{ old('keterangan', $dokumen_kegiatan->keterangan) == 'Sedang Proses' ? 'selected' : '' }}>Sedang Proses</option>
                                    <option value="Selesai" {{ old('keterangan', $dokumen_kegiatan->keterangan) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Ditunda" {{ old('keterangan', $dokumen_kegiatan->keterangan) == 'Ditunda' ? 'selected' : '' }}>Ditunda</option>
                                    <option value="Dibatalkan" {{ old('keterangan', $dokumen_kegiatan->keterangan) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                @error('keterangan')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-4 mb-0">
                                <label for="proposal">File Proposal</label>
                                <input type="file" class="form-control" name="proposal">
                                <p class="text-secondary font-weight-bold text-xs mt-2">
                                    @if ($dokumen_kegiatan->proposal)
                                    Dokumen saat Ini : <a href="{{ asset('dokumen/kegiatan/proposal/'. $dokumen_kegiatan->proposal) }}" target="_blank">Klik Disini</a></p>
                                    @else
                                        Dokumen tidak tersedia
                                    @endif
                                <p class="text-secondary font-weight-bold text-xs mt-2"> Note : File berformat PDF
                                </p>

                                @error('proposal')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4 mb-0">
                                <label for="lpj">File LPJ</label>
                                <input type="file" class="form-control" name="lpj">
                                <p class="text-secondary font-weight-bold text-xs mt-2">
                                    @if ($dokumen_kegiatan->lpj)
                                        Dokumen saat ini: <a href="{{ asset('dokumen/kegiatan/lpj/' . $dokumen_kegiatan->lpj) }}" target="_blank">Klik Disini</a>
                                    @else
                                        Dokumen tidak tersedia
                                    @endif
                                </p>
                                <p class="text-secondary font-weight-bold text-xs mt-2"> Note : File berformat PDF
                                </p>

                                @error('lpj')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4 mb-0">
                                <label for="lpjk">File LPJK</label>
                                <input type="file" class="form-control" name="lpjk">
                                <p class="text-secondary font-weight-bold text-xs mt-2">
                                    @if ($dokumen_kegiatan->lpjk)
                                    Dokumen saat Ini : <a href="{{ asset('dokumen/kegiatan/lpjk/'. $dokumen_kegiatan->lpjk) }}" target="_blank">Klik Disini</a></p>
                                    @else
                                        Dokumen tidak tersedia
                                    @endif
                                <p class="text-secondary font-weight-bold text-xs mt-2"> Note : File berformat PDF
                                </p>

                                @error('lpjk')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
