@extends('layout.layout')
@section('page-title', 'Tambah Prestasi UKM')

@section('content')
    <div class="row mb-4">
        <div class="mb-lg-0 mb-4">
            <div class="col-lg-12">
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6>Edit Prestasi Anggota</h6>
                                </div>
                                <div class="col-lg-3">
                                    <form id="searchForm" class="d-flex">
                                        <input type="text" id="searchInput" class="form-control" name="search"
                                            placeholder="Cari Nama atau NIM..." aria-label="Kata kunci ...">
                                        <button class="btn shadow-none mb-0 btn-outline-dark mx-1" type="button"
                                            id="searchButton">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <!-- Tabel Hasil Pencarian -->
                        <div id="anggotaTable" class="table-responsive">
                            <!-- Hasil pencarian anggota akan muncul di sini -->
                        </div>

                        <!-- Form untuk menambahkan prestasi -->
                        <form action="{{ route('prestasi_anggota.update',$prestasi->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_anggota">Nama Anggota</label>
                                <input type="text" id="nama_anggota" class="form-control" 
                                    value="{{ old('nama_anggota', $prestasi->anggota->nama ?? '') }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="nim_anggota">NIM Anggota</label>
                                <input type="text" id="nim_anggota" class="form-control" 
                                value="{{ old('nim_anggota', $prestasi->anggota->nim ?? '') }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="prestasi">Nama Prestasi</label>
                                <input type="text" name="nama_prestasi" id="prestasi" class="form-control" value="{{ old('nama_prestasi', $prestasi->nama_prestasi) }}" required>
                                @error('nama_prestasi')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="tahun_prestasi">Tahun Prestasi</label>
                                <input type="number" name="tahun_prestasi" id="tahun_prestasi" class="form-control" value="{{ old('tahun_prestasi', $prestasi->tahun_prestasi) }}" required>
                                @error('tahun_prestasi')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="tingkat">Tingkat Prestasi</label>
                                <select name="tingkat" id="tingkat" class="form-control" required>
                                    <option value="" disabled {{ old('tingkat', $prestasi->tingkat) == null ? 'selected' : '' }}>Pilih Prestasi</option>
                                    <option value="lokal" {{ old('tingkat', $prestasi->tingkat) == 'lokal' ? 'selected' : '' }}>Lokal</option>
                                    <option value="nasional" {{ old('tingkat', $prestasi->tingkat) == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="internasional" {{ old('tingkat', $prestasi->tingkat) == 'internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                                @error('tingkat')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan (jika ada)" >{{ old('keterangan', $prestasi->keterangan) }}</textarea>
                                @error('keterangan')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="file">Gambar</label>
                                <br>
                                <img src="{{ asset('dokumen/prestasi_anggota/' . $prestasi->file) }}" alt="{{ $prestasi->file }}" height="200">
                                <input type="file" name="file" id="file" class="form-control" accept="image/*">
                                <p class="text-secondary font-weight-bold text-xs mt-2"> Note : Maksimal ukuran file 2MB dengan format .jpg, .png atau .jpeg</p>
                                @error('file')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                                                    
                            <button type="submit" class="btn btn-success">Simpan Prestasi</button>
                        </form>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
       
@endsection
