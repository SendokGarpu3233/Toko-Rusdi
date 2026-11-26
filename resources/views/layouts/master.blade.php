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

        /*
         * From Uiverse.io by akshat-patel28 - https://uiverse.io/akshat-patel28/quick-baboon-29
         * MIT License, Copyright (c) akshat-patel28 (Akshat Patel)
         * Scoped classes agar tidak bentrok dengan class .card bawaan Bootstrap
         */
        .uiverse-toast-wrap {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            animation: uiverseSlideIn 0.35s ease-out;
        }
        @keyframes uiverseSlideIn {
            from { opacity: 0; transform: translateX(40px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .uiverse-toast-card {
            width: 330px;
            max-width: calc(100vw - 40px);
            min-height: 80px;
            border-radius: 8px;
            box-sizing: border-box;
            padding: 10px 15px;
            background-color: #ffffff;
            box-shadow: rgba(149, 157, 165, 0.25) 0px 8px 24px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 15px;
        }
        .uiverse-toast-wave {
            position: absolute;
            transform: rotate(90deg);
            left: -31px;
            top: 32px;
            width: 80px;
            fill: #04e4003a;
            pointer-events: none;
        }
        .uiverse-toast-icon-wrap {
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #04e40048;
            border-radius: 50%;
            margin-left: 8px;
        }
        .uiverse-toast-icon {
            width: 17px;
            height: 17px;
            color: #269b24;
        }
        .uiverse-toast-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            flex-grow: 1;
        }
        .uiverse-toast-title,
        .uiverse-toast-sub {
            margin: 0;
            cursor: default;
        }
        .uiverse-toast-title {
            color: #269b24;
            font-size: 16px;
            font-weight: 700;
            line-height: 1.2;
        }
        .uiverse-toast-sub {
            font-size: 13px;
            color: #555;
            line-height: 1.3;
        }
        .uiverse-toast-close {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            color: #555;
            cursor: pointer;
        }
        /* Variasi warna merah untuk Toast Error */
        .uiverse-toast-error .uiverse-toast-wave {
            fill: #ef44443a;
        }
        .uiverse-toast-error .uiverse-toast-icon-wrap {
            background-color: #ef444433;
        }
        .uiverse-toast-error .uiverse-toast-icon,
        .uiverse-toast-error .uiverse-toast-title {
            color: #dc2626;
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

    {{-- From Uiverse.io by akshat-patel28 - https://uiverse.io/akshat-patel28/quick-baboon-29 --}}
    {{-- MIT License, Copyright (c) akshat-patel28 (Akshat Patel) --}}
    @if (session('pesan'))
        <div class="uiverse-toast-wrap" id="uiverseToast">
            <div class="uiverse-toast-card">
                <svg class="uiverse-toast-wave" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,320,274,320C251.4,320,229,320,206,320C182.9,320,160,320,137,320C114.3,320,91,320,69,320C45.7,320,23,320,11,320L0,320Z" fill-opacity="1"></path>
                </svg>

                <div class="uiverse-toast-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke-width="0" fill="currentColor" stroke="currentColor" class="uiverse-toast-icon">
                        <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"></path>
                    </svg>
                </div>

                <div class="uiverse-toast-text">
                    <p class="uiverse-toast-title">Berhasil!</p>
                    <p class="uiverse-toast-sub">{{ session('pesan') }}</p>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" stroke-width="0" fill="none" stroke="currentColor" class="uiverse-toast-close" onclick="document.getElementById('uiverseToast').remove()">
                    <path fill="currentColor" d="M11.7816 4.03157C12.0062 3.80702 12.0062 3.44295 11.7816 3.2184C11.5571 2.99385 11.193 2.99385 10.9685 3.2184L7.50005 6.68682L4.03164 3.2184C3.80708 2.99385 3.44301 2.99385 3.21846 3.2184C2.99391 3.44295 2.99391 3.80702 3.21846 4.03157L6.68688 7.49999L3.21846 10.9684C2.99391 11.193 2.99391 11.557 3.21846 11.7816C3.44301 12.0061 3.80708 12.0061 4.03164 11.7816L7.50005 8.31316L10.9685 11.7816C11.193 12.0061 11.5571 12.0061 11.7816 11.7816C12.0062 11.557 12.0062 11.193 11.7816 10.9684L8.31322 7.49999L11.7816 4.03157Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <script>
            setTimeout(function () {
                const toast = document.getElementById('uiverseToast');
                if (toast) toast.remove();
            }, 4000);
        </script>
    @endif

    @if (session('error') || $errors->any())
        <div class="uiverse-toast-wrap" id="uiverseToastError">
            <div class="uiverse-toast-card uiverse-toast-error">
                <svg class="uiverse-toast-wave" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,320,274,320C251.4,320,229,320,206,320C182.9,320,160,320,137,320C114.3,320,91,320,69,320C45.7,320,23,320,11,320L0,320Z" fill-opacity="1"></path>
                </svg>

                <div class="uiverse-toast-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="uiverse-toast-icon">
                        <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c-13.3 0-24 10.7-24 24V264c0 13.3 10.7 24 24 24s24-10.7 24-24V152c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"></path>
                    </svg>
                </div>

                <div class="uiverse-toast-text">
                    <p class="uiverse-toast-title">Gagal!</p>
                    <p class="uiverse-toast-sub">{{ session('error') ?? $errors->first() }}</p>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" stroke-width="0" fill="none" stroke="currentColor" class="uiverse-toast-close" onclick="document.getElementById('uiverseToastError').remove()">
                    <path fill="currentColor" d="M11.7816 4.03157C12.0062 3.80702 12.0062 3.44295 11.7816 3.2184C11.5571 2.99385 11.193 2.99385 10.9685 3.2184L7.50005 6.68682L4.03164 3.2184C3.80708 2.99385 3.44301 2.99385 3.21846 3.2184C2.99391 3.44295 2.99391 3.80702 3.21846 4.03157L6.68688 7.49999L3.21846 10.9684C2.99391 11.193 2.99391 11.557 3.21846 11.7816C3.44301 12.0061 3.80708 12.0061 4.03164 11.7816L7.50005 8.31316L10.9685 11.7816C11.193 12.0061 11.5571 12.0061 11.7816 11.7816C12.0062 11.557 12.0062 11.193 11.7816 10.9684L8.31322 7.49999L11.7816 4.03157Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <script>
            setTimeout(function () {
                const toastErr = document.getElementById('uiverseToastError');
                if (toastErr) toastErr.remove();
            }, 5000);
        </script>
    @endif

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