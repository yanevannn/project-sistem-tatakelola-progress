@extends('layout.layout')
@section('page-title', 'Data Prestasi Anggota UKM')

@section('content')
    <div class="row mb-4">
        <div class="mb-lg-0 mb-4">
            <div class="col-lg-12">
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6>Tambah Prestasi Anggota</h6>
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

                    <div class="card-body">
                        <!-- Tabel Hasil Pencarian -->
                        <div id="anggotaTable" class="table-responsive">
                            <!-- Hasil pencarian anggota akan muncul di sini -->
                        </div>

                        <!-- Form untuk menambahkan prestasi -->
                        <form action="{{ route('prestasi_anggota.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="id_anggota" id="id_anggota" class="form-control" value="{{ old('id_anggota') }}" hidden>
                            </div>

                            <div class="form-group">
                                <label for="nama_anggota">Nama Anggota</label>
                                <input type="text" id="nama_anggota_disabled" class="form-control" 
                                    value="{{ old('nama_anggota', $anggota->nama ?? '') }}" readonly disabled>
                                <input type="hidden" name="nama_anggota" id="nama_anggota" 
                                    value="{{ old('nama_anggota', $anggota->nama ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="nim_anggota">NIM Anggota</label>
                                <input type="text" id="nim_anggota_disabled" class="form-control" 
                                    value="{{ old('nim_anggota', $anggota->nim ?? '') }}" readonly disabled>
                                <input type="hidden" name="nim_anggota" id="nim_anggota" 
                                    value="{{ old('nim_anggota', $anggota->nim ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="prestasi">Nama Prestasi</label>
                                <input type="text" name="nama_prestasi" id="prestasi" class="form-control" value="{{ old('nama_prestasi') }}" required>
                                @error('nama_prestasi')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="tahun_prestasi">Tahun Prestasi</label>
                                <input type="number" name="tahun_prestasi" id="tahun_prestasi" class="form-control" value="{{ old('tahun_prestasi') }}" required>
                                @error('tahun_prestasi')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="tingkat">Tingkat Prestasi</label>
                                <select name="tingkat" id="tingkat" class="form-control" required>
                                    <option value="" disabled {{ old('tingkat') == null ? 'selected' : '' }}>Pilih Prestasi</option>
                                    <option value="lokal" {{ old('tingkat') == 'lokal' ? 'selected' : '' }}>Lokal</option>
                                    <option value="nasional" {{ old('tingkat') == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="internasional" {{ old('tingkat') == 'internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                                @error('tingkat')
                                        <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="file">Gambar</label>
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

    <!-- Script untuk menangani AJAX Pencarian dan Pilih Anggota -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchButton').on('click', function() {
                var search = $('#searchInput').val();

                $.ajax({
                    url: "{{ route('prestasi_anggota.search') }}",
                    method: "GET",
                    data: {
                        search: search
                    },
                    success: function(data) {
                        var html = `
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Periode</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>`;
                        if (data.length > 0) {
                            // Looping untuk setiap anggota
                            data.forEach(function(anggota, index) {
                                html += `
                            <tr>
                                <td class="text-xs align-middle text-center">${index + 1}</td>
                                <td class="text-xs align-middle text-center">${anggota.nama}</td>
                                <td class="text-xs align-middle text-center">${anggota.nim}</td>
                                <td class="text-xs align-middle text-center">${anggota.periode ? anggota.periode.tahun : 'Tidak Ada'}</td>
                                <td class="text-xs align-middle text-center">${anggota.kelas}</td>
                                <td class="text-xs align-middle text-center">
                                    <button class="btn btn-success btn-sm" 
                                            onclick="selectAnggota(${anggota.id}, '${anggota.nama}', '${anggota.nim}')">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        `;
                            });
                        } else {
                            html += `
                        <tr>
                            <td colspan="4" class="text-center">Anggota tidak ditemukan.</td>
                        </tr>`;
                        }

                        html += `
                        </tbody>
                    </table>`;
                        $('#anggotaTable').html(html);
                    }
                });
            });
        });


        // Fungsi untuk memilih anggota dan mengisi form
        function selectAnggota(id, nama, nim) {
            // console.log('ID:', id);  
            // console.log('Nama:', nama);  
            // console.log('NIM:', nim); 
            $('#id_anggota').val(id);
            $('#nama_anggota').val(nama);
            $('#nim_anggota').val(nim);
            // Menampilkan Nama dan NIM di input yang readonly
            $('#nama_anggota_disabled').val(nama);
            $('#nim_anggota_disabled').val(nim);
        }
    </script>
@endsection
