@extends('layout.layout')
@section('page-title', 'Data Anggota UKM')

@section('content')
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Tambah Data Anggota</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token CSRF untuk keamanan Laravel -->
                    <div>
                        <button type="submit" class="btn bg-gradient-success mb-0 font-weight-bold text-xs text-white">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
