<!-- Side Navbar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" " target="">
            <img src={{ asset('assets/img/faviconV2.png') }} class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">SITA PROGRESS</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}" href="/dashboard">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-archive-2 bg-secondary"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('periode*') ? 'active' : '' }}" href="/periode">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-archive-2 bg-secondary"></i>
                    </div>
                    <span class="nav-link-text ms-1">Periode</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('inventaris*') ? 'active' : '' }}" href="/inventaris">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-archive-2 bg-secondary"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inventaris</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('keuangan*') ? 'active' : '' }}" href="/keuangan">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-archive-2 bg-secondary"></i>
                    </div>
                    <span class="nav-link-text ms-1">Keuangan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('user*') ? 'active' : '' }}" href="/user">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-archive-2 bg-secondary"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pengurus</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('suratmasuk*') ? 'active' : '' }}" href="/suratmasuk">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-archive-2 bg-secondary"></i>
                    </div>
                    <span class="nav-link-text ms-1">Surat Masuk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('suratkeluar*') ? 'active' : '' }}" href="/suratkeluar">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-archive-2 bg-secondary"></i>
                    </div>
                    <span class="nav-link-text ms-1">Surat Keluar</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<!-- End Side Navbar -->
