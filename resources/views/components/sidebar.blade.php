<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">{{ klien('nama_client') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}"><i class="fa fa-mosque"></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item ">
                <a href="{{ route('dashboard') }}" class="nav-link "><i
                        class="fas fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item {{ Request::is('penduduk*') ? 'active' : '' }}">
                <a href="{{ route('penduduk.index') }}" class="nav-link "><i
                        class="fas fa-users"></i><span>Penduduk</span></a>
            </li>
            @if (auth()->user()->roles == 'superadmin' || auth()->user()->roles == 'admin')
                <li class="nav-item {{ Request::is('profil*') ? 'active' : '' }}">
                    <a href="{{ route('profil-bisnis.edit', auth()->user()->perusahaan_id) }}" class="nav-link "><i
                            class="fas fa-mosque"></i><span>Profil</span></a>
                </li>
                <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="nav-link "><i class="fas fa-users"></i><span>User
                            List</span></a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link "><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post">@csrf</form>
                </li>
    </aside>
</div>
