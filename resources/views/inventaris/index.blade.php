@extends('layout.layout')
@section('page-title', 'Data Inventaris')

@section('content')
<div class="row mb-4">
    <div class="mb-lg-0 mb-4">
        <div class="col-lg-12">
            @if(auth()->user()->isPengurus())
            <div class="row">
                <div class="col-8">
                </div>
                <div class="col-lg-4 d-flex justify-content-end align-items-end">
                    <button class="btn bg-gradient-success">
                        <a href="{{ route('inventaris.create') }}" class="font-weight-bold text-xs text-white" data-toggle="tooltip"
                            data-original-title="tambah">Tambah Data</a>
                    </button>
                </div>
            </div>
            @endif
            <div class="card p-3">
                <div class="container-fluid px-0">
                    <div class="card-header">
                        <h6>Tabel Inventaris UKM</h6>
                    </div>
                </div>

                <div class="card-body p-3">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="inventarisTable">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gambar barang</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah barang</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sumber</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kondisi barang</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                                    @if (auth()->user()->isPengurus())
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventaris as $i)
                                <tr>
                                    <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ url('image') }}/inventaris/{{ $i->gambar }}" alt="" srcset="" width="150">
                                    </td>
                                    <td>
                                        <p class="text-xs text-center font-weight-bold mb-0">{{ $i->nama_barang }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-center font-weight-bold mb-0">{{ $i->jumlah }} {{ $i->satuan }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-center font-weight-bold mb-0">{{ $i->sumber_pengadaan }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-center font-weight-bold mb-0">{{ $i->kondisi }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-center font-weight-bold mb-0">{{ $i->keterangan }}</p>
                                    </td>
                                    @if (auth()->user()->isPengurus())
                                    <td class="align-middle text-center">
                                        <a href="{{ route('inventaris.edit', $i->id) }}"
                                            class="font-weight-bold text-xs text-white btn btn-warning mb-0"
                                            data-toggle="tooltip" data-original-title="Edit">EDIT</a>
                                        <form action="{{ route('inventaris.destroy', $i->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mb-0 font-weight-bold text-xs delete"
                                                data-barang="{{ $i->nama_barang }}" data-toggle="tooltip" data-original-title="Delete">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                const namabarang = this.getAttribute(
                    'data-barang'); // Ambil nilai periode dari atribut data-barang

                swal({
                        title: "Apakah Anda yakin?",
                        text: "Data " + namabarang + " yang dihapus tidak bisa dikembalikan!",
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
    <script>
        $(document).ready(function() {
            $('#inventarisTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
