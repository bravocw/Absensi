<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img alt="image" src="../assets/img/logo.png" class="rounded-circle mr-1" style="width: 150px; height: 150px;"><br>
            <a href="">{{ config('app.name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">{{ substr(config('app.name'), 0, 2) }}</a>
        </div>
        <ul class="sidebar-menu">
            @if (auth()->user()->role == 'guru')
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown{{ request()->is('admin/barang') ? ' active' : '' }}">
                <a href="{{ route('data.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Manajemen Absensi</li>
            <li class="nav-item dropdown{{ request()->is('admin/barang') ? ' active' : '' }}">
                <a href="{{ route('data.index') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Riwayat Absen</span></a>
            </li>
            <li class="nav-item dropdown{{ request()->is('admin/pengurus') ? ' active' : '' }}">
                <a href="{{ route('pengurus.index') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Data
                        Admin</span></a>
            </li>
            @endif

            @if (auth()->user()->role == 'siswa')
            <li class="menu-header">Manajemen Absensi</li>
            <li class="nav-item dropdown{{ request()->is('admin/barang') ? ' active' : '' }}">
                <a href="{{ route('data.index') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Absen Mata Pelajaran</span></a>
            </li>
            @endif
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a class="btn btn-danger btn-lg btn-block btn-icon-split" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>
</div>