@extends('layout.layout')
@section('page-title', 'Dokumen UKM')

@section('content')
    <div class="row mb-4">
        <div class=" mb-lg-0 mb-4">
            <div class="col-lg-12">
                <div class="card p-3">
                    <div class="container-fluid px-0">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6>Dokumen UKM {{ $type }} Periode {{ $periode }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="text-center pb-2">Pratinjau Dokumen</h5>
                        <div>
                            <iframe src="{{ $filePath }}" 
                                    width="100%" 
                                    height="600" 
                                    frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
