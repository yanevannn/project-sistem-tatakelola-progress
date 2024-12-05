@extends('layout.layout')
@section('page-title', 'Perbarui Data Periode')

@section('content')
    <div class="row mt-4 mb-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Perbarui Periode</h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('periode.update', $periode->id) }}" method="POST">
                        @csrf <!-- Token CSRF untuk keamanan Laravel -->
                        @method('PUT') <!-- Ini digunakan untuk menentukan metode PUT -->
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <input type="text" name="periode" class="form-control"
                                placeholder="{{ old('periode', $periode->tahun) }}"
                                value="{{ old('periode', $periode->tahun) }}"required>
                            <!-- Menampilkan pesan error -->
                            @error('periode')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control mb-4" required>
                                <option value="aktif" {{ $periode->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="non-aktif" {{ $periode->status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif
                                </option>
                            </select>
                            <!-- Menampilkan pesan error -->
                            @error('status')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
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
