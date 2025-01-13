@extends('layout.layout')
@section('page-title', 'Data Pengurus UKM')

@section('content')
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Edit Data Pengurus</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('user.update', $pengurus->id) }}" method="POST">
                    @csrf <!-- Token CSRF untuk keamanan Laravel -->
                    @method("PUT")
                    <div class="form-group col-lg-6">
                        <label for="periode">Periode</label>
                        <select name="periode" class="form-control" required>
                            <option value="{{ $pengurus->id_periode }}" selected>
                                {{ $pengurus->periode->tahun }}
                            </option>
                            @foreach ($periode as $p)
                                <option value="{{ $p->id }}" {{ $pengurus->id_periode == $p->id ? 'selected' : '' }}>
                                    {{ $p->tahun }}
                                </option>
                            @endforeach
                        </select>
                        @error('periode')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="form-group col-lg-6">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" class="form-control" value="{{ old('nim', $pengurus->anggota->nim) }}" required>
                        @error('nim')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $pengurus->email) }}" required>
                        @error('nim')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $pengurus->anggota->nama) }}" required>
                        @error('nama')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="role">Jabatan</label>
                        <select name="role" class="form-control" required>
                            <option value="" disabled>-- Pilih Jabatan --</option>
                            <option value="Ketua" {{ old('role', $pengurus->role) == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                            <option value="Wakil Ketua" {{ old('role', $pengurus->role) == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                            <option value="Bendahara" {{ old('role', $pengurus->role) == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                            <option value="Sekretaris" {{ old('role', $pengurus->role) == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                            <option value="Divisi I" {{ old('role', $pengurus->role) == 'Divisi I' ? 'selected' : '' }}>Divisi I</option>
                            <option value="Divisi II" {{ old('role', $pengurus->role) == 'Divisi II' ? 'selected' : '' }}>Divisi II</option>
                            <option value="Divisi III" {{ old('role', $pengurus->role) == 'Divisi III' ? 'selected' : '' }}>Divisi III</option>
                        </select>
                        @error('role')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-lg-6">
                        <label for="jenis_kelamin">Gender</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="" disabled>-- Pilih Gender --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $pengurus->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $pengurus->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="no_hp">No Telephone</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pengurus->anggota->no_hp) }}" required>
                        @error('no_hp')
                            <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
