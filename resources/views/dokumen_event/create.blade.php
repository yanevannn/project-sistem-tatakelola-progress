@extends('layout.layout')
@section('page-title', 'Data Dokumen Event')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Tambah Dokumen Event UKM</h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('dokumen_event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Token CSRF untuk keamanan Laravel -->
                        <div class="row">
                            <div class="form-group col-lg-6 mb-0">
                                <div class="form-group">
                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                    <input type="text" name="nama_kegiatan" class="form-control"
                                        placeholder="masukkan nama kegiatan" value="{{ old('nama_kegiatan') }}">
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
                                        <option value="{{ $p->id }}" {{ old('periode') == $p->id ? 'selected' : '' }}>
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
                                <input type="date" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">        
                                @error('tanggal_mulai')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                                @error('tanggal_selesai')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="keterangan">Keterangan</label>
                                <select class="form-control" name="keterangan" id="keterangan">
                                    <option value="Sedang Proses" {{ old('keterangan', 'Sedang Proses') == 'Sedang Proses' ? 'selected' : '' }}>Sedang Proses</option>
                                    <option value="Selesai" {{ old('keterangan', 'Sedang Proses') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Ditunda" {{ old('keterangan', 'Sedang Proses') == 'Ditunda' ? 'selected' : '' }}>Ditunda</option>
                                    <option value="Dibatalkan" {{ old('keterangan', 'Sedang Proses') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                {{-- @error('keterangan')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4 mb-0">
                                <label for="proposal">File Proposal</label>
                                <input type="file" class="form-control" name="proposal">
                                <p class="text-secondary font-weight-bold text-xs mt-2"> Note : File berformat PDF
                                </p>

                                @error('proposal')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4 mb-0">
                                <label for="lpj">File LPJ</label>
                                <input type="file" class="form-control" name="lpj">
                                <p class="text-secondary font-weight-bold text-xs mt-2"> Note : File berformat PDF
                                </p>

                                @error('lpj')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4 mb-0">
                                <label for="lpjk">File LPJK</label>
                                <input type="file" class="form-control" name="lpjk">
                                <p class="text-secondary font-weight-bold text-xs mt-2"> Note : File berformat PDF
                                </p>

                                @error('lpjk')
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
@section('script')
@if ($errors->has('keterangan'))
    <script>
        Swal.fire({
            title: 'Terjadi Kesalahan!',
            text: 'Keterangan "Selesai" tidak dapat dipilih jika file proposal, LPJ, dan LPJK kosong.',
            icon: 'error',
            confirmButtonText: 'Tutup'
        });
    </script>
@endif
@endsection