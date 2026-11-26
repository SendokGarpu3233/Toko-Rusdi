<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="position: sticky; top: 0; height: 100vh; overflow-y: auto; overflow-x: hidden; flex-shrink: 0;  z-index: 1000;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-boxes"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Toko Rusdi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{request()->is('/')? 'active' : ''}}">
                <a class="nav-link" href="/">
                    <i class="far fa-fw fa-chart-bar"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Daftar Produk
            </div>


            <!-- Nav Item - Tables -->
            <li class="nav-item {{request()->is('produk')? 'active' : ''}}">
                <a class="nav-link" href="/produk">
                    <i class="fas fa-fw fa-box-open"></i>
                    <span>Produk</span></a>
            </li>
            <li class="nav-item {{request()->is('Kategori')? 'active' : ''}}">
                <a class="nav-link" href="/Kategori">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Kategori</span></a>
            </li>

            @if (Auth::user() && Auth::user()->role == 'super_admin')
            <li class="nav-item {{ request ()->is('produk/trash') ? 'active' : '' }}">
                <a class="nav-link" href="/produk/trash">
                    <i class="fas fa-fw fa-trash-restore"></i>
                    <span>Sampah</span>
                </a>
            </li>
            @endif



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->