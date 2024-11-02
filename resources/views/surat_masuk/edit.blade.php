@extends('layout.layout')
@section('page-title', 'Perbarui Surat Masuk')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Tambah Surat Masuk</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('index.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token CSRF untuk keamanan Laravel -->
                    <div class="row coll-lg 12">
                        <input type="text" name="id_user" value="1" hidden>
                        <div class="form-group col-lg-6">
                            <label for="status">Periode</label>
                            <select name="status" class="form-control " required>
                                <option value="" disabled selected>Pilih Periode</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="periode">Nomor Surat</label>
                            <input type="number" name="no_surat" class="form-control"
                                placeholder="masukkan no surat" value=""required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="periode">Penerima</label>
                            <input type="text" name="penerima" class="form-control"
                                placeholder="masukkan penerima surat" value=""required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="periode">Pengirim</label>
                            <input type="text" name="pengirim" class="form-control"
                                placeholder="masukkan pengirim surat" value=""required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="periode">Tanggal Masuk</label>
                            <input type="text" name="tanggalmasuk" class="form-control"
                                placeholder="masukkan tanggal masuk surat" value=""required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="periode">Tanggal Kegiatan</label>
                            <input type="text" name="tanggalkegiatan" class="form-control"
                                placeholder="masukkan tanggal kegiatan surat" value=""required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="foto">File Surat</label>
                        <input type="file" class="form-control" name="file">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div> <!-- Menampilkan pesan kesalahan -->
                        @enderror
                    </div>
                    <button type="submit"
                        class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
