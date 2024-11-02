@extends('layout.layout')
@section('page-title', 'Periode')

@section('content')
    <div class="row mt-4 mb-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Input Periode</h6>
                </div>
                <div class="card-body p-3">
                    <form action="/periode" method="POST">
                        @csrf <!-- Token CSRF untuk keamanan Laravel -->
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <input type="text" name="periode" class="form-control" placeholder="masukkan periode"required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control mb-4" required>
                                <option value="" disabled selected>Pilih status</option>
                                <option value="aktif" >Aktif</option>
                                <option value="non-aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card h-100 p-3">
                <div class="card-header pb-0">
                    <h6>Tabel Periode</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center testext-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($periode as $pd)
                                    <tr>
                                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $pd->tahun }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($pd->status === 'aktif')
                                                <span class="badge badge-sm bg-success">{{ $pd->status }}</span>
                                            @else
                                                <span class="badge badge-sm bg-danger">{{ $pd->status }}</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center">

                                            <a href="{{ route('periode.edit', $pd->id) }}"
                                                class="font-weight-bold text-xs text-white btn btn-warning mb-0"
                                                data-toggle="tooltip" data-original-title="Edit">EDIT</a>

                                            <form action="{{ route('periode.destroy', $pd->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger mb-0 font-weight-bold text-xs delete "
                                                    data-periode="{{ $pd->tahun }}" data-toggle="tooltip"
                                                    data-original-title="Delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Event handler untuk tombol delete
        document.querySelectorAll('.delete').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah submit form otomatis

                const form = this.closest('form'); // Ambil form terdekat dari tombol
                const periode = this.getAttribute(
                    'data-periode'); // Ambil nilai periode dari atribut data-periode

                swal({
                        title: "Apakah Anda yakin?",
                        text: "Data Periode " + periode + " yang dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit(); // Jika konfirmasi delete, submit form
                        } else {
                            swal("Data Anda aman!"); // Jika batal, tampilkan pesan
                        }
                    });
            });
        });
    </script>
@endsection
