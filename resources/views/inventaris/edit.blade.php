@extends('layout.layout')
@section('page-title', 'Data Inventaris')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Edit Data Inventaris</h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('inventaris.update', $inventaris->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row coll-lg 12">
                            <input type="text" name="id_user" value="{{ $inventaris->id_user }}" hidden>
                            <div class="form-group col-lg-6">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control"
                                    placeholder="masukan nama barang" value="{{ $inventaris->nama_barang }}"required>
                                @error('foto')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control"
                                    placeholder="masukkan jumlah barang" value="{{ $inventaris->jumlah }}"required>
                                @error('jumlah')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" class="form-control"
                                    placeholder="masukkan satuan barang" value="{{ $inventaris->satuan }}"required>
                                @error('satuan')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="sumber_pengadaan">Sumber Pengadaan</label>
                                <input type="text" name="sumber_pengadaan" class="form-control"
                                    placeholder="masukkan sumber pengadaan"
                                    value="{{ $inventaris->sumber_pengadaan }}"required>
                                @error('sumber_pengadaan')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control"
                                    placeholder="tambahkan keterangan" value="{{ $inventaris->keterangan }}"required>
                                @error('keterangan')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="status">Kondisi</label>
                                <select name="status" class="form-control mb-4" required>
                                    <option value="baik" {{ $inventaris->kondisi == 'baik' ? 'selected' : '' }}>Baik
                                    </option>
                                    <option value="rusak" {{ $inventaris->kondisi == 'rusak' ? 'selected' : '' }}>Rusak
                                    </option>
                                    <option value="perbaikan" {{ $inventaris->kondisi == 'perbaikan' ? 'selected' : '' }}>
                                        Perbaikan</option>
                                    <option value="hilang" {{ $inventaris->kondisi == 'hilang' ? 'selected' : '' }}>Hilang
                                    </option>
                                </select>
                                @error('status')
                                    <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Inventaris</label>
                            <br>
                            <img src="{{ url('image') }}/inventaris/{{ $inventaris->gambar }}" class="mb-4"
                                alt="Foto Lama" srcset="" height="150">
                            <input type="file" class="form-control" id="foto" name="foto">
                            <p class="text-secondary font-weight-bold text-xs mt-2"> Note : Maksimal ukuran gambar 2MB </p>
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div> <!-- Menampilkan pesan kesalahan -->
                            @enderror
                        </div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
