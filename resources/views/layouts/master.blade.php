<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Toko Rusdi - @yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom fonts for this template-->
    <link href="{{asset('sbadmin')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('sbadmin')}}/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Optimasi tampilan agar lega dan rapi di layar HP (Mobile) -->
    <style>
        @media (max-width: 767.98px) {
            .container-fluid {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            .card-body {
                padding: 0.9rem;
            }
            .table td, .table th {
                padding: 0.5rem;
                font-size: 0.875rem;
                vertical-align: middle;
            }
            h1, h2, .h3 {
                font-size: 1.35rem;
            }
            /* Ubah garis pemisah kiri jadi garis atas saat kolom menumpuk di HP */
            .row > .border-left {
                border-left: none !important;
                border-top: 1px solid #e3e6f0;
                padding-top: 0.75rem;
            }
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      @include('layouts.sidebar')  
      <script>
          // Di HP (< 768px), otomatis sembunyikan sidebar di awal agar konten 100% lega
          // Di Laptop (>= 768px), ikuti status tersimpan di localStorage (tanpa kedip)
          if (window.innerWidth < 768 || localStorage.getItem('sidebarToggled') === 'true') {
              document.body.classList.add('sidebar-toggled');
              document.getElementById('accordionSidebar').classList.add('toggled');
          }
      </script>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

          @include('layouts.navbar')      

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
                        @yield('konten')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       @include('layouts.footer')     

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout untuk keluar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin ingin Keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary" href="/logout">Iya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('sbadmin')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('sbadmin')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('sbadmin')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('sbadmin')}}/js/sb-admin-2.min.js"></script>

    <!-- Simpan status buka/tutup sidebar ke localStorage (khusus layar desktop) -->
    <script>
        $('#sidebarToggle, #sidebarToggleTop').on('click', function () {
            if (window.innerWidth >= 768) {
                const isToggled = $('#accordionSidebar').hasClass('toggled');
                localStorage.setItem('sidebarToggled', isToggled);
            }
        });
    </script>

</body>

</html>