<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/faviconV2.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/faviconV2.png') }}">
    <title>
        Sistem Tata Kelola Progress
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
    
    @vite(['resources/css/app.css'])

    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/brands.min.css"
    integrity="sha512-EJp8vMVhYl7tBFE2rgNGb//drnr1+6XKMvTyamMS34YwOEFohhWkGq13tPWnK0FbjSS6D8YoA3n3bZmb3KiUYA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Sweat Allert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    <!-- DataTables CSS -->
    {{-- <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/jquery.dataTables.css') }}" rel="stylesheet">
    <!-- DataTables JS -->
    {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>


</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('layout.partials.sidenav')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layout.partials.navbar')
        <!-- Content Section -->
        <div class="container-fluid py-4">
            @yield('content')
        </div>
        <!-- End Content Section -->
    </main>


    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('script')
    <!-- Pesan untuk Data berhasil disimpan -->
    @if (session('loginTrue'))
        <script>
            Swal.fire({
                title: 'Login Information',
                text: "{{ session('loginTrue') }}",
                icon: 'info',
                confirmButtonText: 'Oke'
            });
        </script>
    @endif

    <!-- Pesan untuk Data berhasil disimpan -->
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Oke'
            });
        </script>
    @endif

    <!-- Pesan untuk Data berhasil diupdate -->
    @if (session('updated'))
        <script>
            Swal.fire({
                title: 'Diupdate!',
                text: "{{ session('updated') }}",
                icon: 'info',
                confirmButtonText: 'Oke'
            });
        </script>
    @endif
</body>

</html>
