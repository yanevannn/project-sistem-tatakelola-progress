@extends('layout.layout')
@section('page-title', 'Dashboard')

@section('content')

    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png" class="bg-white rounded-circle" alt="profile_image">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $user->anggota->nama }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ $user->role }}
                    </p>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active " href="{{ route('dashboard.profile') }}"
                                role="tab" aria-selected="true">
                                <span class="ms-1">Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>INFORMATION</h6>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    @if (auth()->check() && auth()->user()->isPengurusInti())
                                    
                                    <!-- Section Periode-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('periode*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-refresh-ccw-dot">
                                                                <path d="M3 2v6h6" />
                                                                <path d="M21 12A9 9 0 0 0 6 5.3L3 8" />
                                                                <path d="M21 22v-6h-6" />
                                                                <path d="M3 12a9 9 0 0 0 15 6.7l3-2.7" />
                                                                <circle cx="12" cy="12" r="1" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            {{ $periode }}
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Total Periode</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section Pengurus-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('user*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-user-check">
                                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                                <circle cx="9" cy="7" r="4" />
                                                                <polyline points="16 11 18 13 22 9" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            2
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Total Pengurus</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section keuangan-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('keuangan*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-hand-coins">
                                                                <path
                                                                    d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                                                                <path
                                                                    d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                                                                <path d="m2 16 6 6" />
                                                                <circle cx="16" cy="9" r="2.9" />
                                                                <circle cx="6" cy="5" r="3" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            Rp. {{ number_format($keuangan, 0, ',', '.') }}
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Total KAS</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section Surat Masuk-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('suratmasuk*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-file-input">
                                                                <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" />
                                                                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                                                <path d="M2 15h10" />
                                                                <path d="m9 18 3-3-3-3" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            {{ $suratmasuk }}
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Total Surat Masuk</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section Surat Keluar-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('suratkeluar*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-file-output">
                                                                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                                                <path d="M4 7V4a2 2 0 0 1 2-2 2 2 0 0 0-2 2" />
                                                                <path
                                                                    d="M4.063 20.999a2 2 0 0 0 2 1L18 22a2 2 0 0 0 2-2V7l-5-5H6" />
                                                                <path d="m5 11-3 3" />
                                                                <path d="m5 17-3-3h10" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            {{ $suratkeluar }}
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Total Surat Keluar</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section Dokumen UKM-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('dokumen_ukm*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-scroll-text">
                                                                <path d="M15 12h-5" />
                                                                <path d="M15 8h-5" />
                                                                <path d="M19 17V5a2 2 0 0 0-2-2H4" />
                                                                <path
                                                                    d="M8 21h12a2 2 0 0 0 2-2v-1a1 1 0 0 0-1-1H11a1 1 0 0 0-1 1v1a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v2a1 1 0 0 0 1 1h3" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            {{ $dokumenukm }}
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Total Dokumen UKM</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section Dokumen Event-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('dokumen_kegiatan*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-book-marked">
                                                                <path d="M10 2v8l3-3 3 3V2" />
                                                                <path
                                                                    d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            {{ $dokumenevent }}
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Total Dokumen Event</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- Section Anggota-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('anggota*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-users">
                                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                                <circle cx="9" cy="7" r="4" />
                                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            {{ $anggota }}
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Total Anggota</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('prestasianggota*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-award">
                                                                <path
                                                                    d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526" />
                                                                <circle cx="12" cy="8" r="6" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            {{ $prestasi }}
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Prestasi Anggota</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section-->
                                    <div class="col-sm-2 col-lg-3 col-md-4 mb-4">
                                        <div class="card">
                                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                                            <div class="card-body p-3 position-relative text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                        <div
                                                            class="icon icon-shape bg-white shadow text-center border-radius-2xl mx-auto d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                stroke="{{ request()->is('inventaris*') ? 'white' : 'black' }}"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-package">
                                                                <path
                                                                    d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z" />
                                                                <path d="M12 22V12" />
                                                                <path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7" />
                                                                <path d="m7.5 4.27 9 5.15" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                                            {{ $inventaris }}
                                                        </h5>
                                                        <span class="text-white text-sm mt-2">Total Inventaris</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
