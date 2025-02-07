@extends('layout.layout')
@section('page-title', 'Data Periode')

@section('content')
    <div class="row mt-4 mb-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Edit Data Periode</h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('periode.update', $periode->id) }}" method="POST" id="periodeForm">
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
                            <select name="status" class="form-control mb-4" id="statusSelect" required>
                                <option value="aktif" {{ $periode->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="non-aktif" {{ $periode->status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif
                                </option>
                            </select>
                            <!-- Menampilkan pesan error -->
                            @error('status')
                                <div class="text-danger font-weight-bold text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="button"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white" id="submitBtn">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        document.getElementById('submitBtn').addEventListener('click', function() {
            let status = document.getElementById('statusSelect').value;

            if (status === 'aktif') {
                Swal.fire({
                    title: "Konfirmasi Perubahan Status",
                    text: "Anda akan mengaktifkan periode ini, periode lain akan otomatis menjadi non-aktif. Lanjutkan?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Lanjutkan"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('periodeForm').submit();
                    }
                });
            } else {
                document.getElementById('periodeForm').submit();
            }
        });
    </script>
@endsection
