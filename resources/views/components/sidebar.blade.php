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
            <li class="nav-item dropdown {{ Request::is('penduduk*', 'zis-category*', 'user*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i><span>Master
                        Data</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('penduduk') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('penduduk.index') }}"><i
                                class="fas fa-users"></i><span>Penduduk</span></a>
                    </li>
                    <li class="{{ Request::is('zis-category') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('zis-category.index') }}"><i
                                class="fas fa-moon"></i><span>Kategori ZIS</span></a>
                    </li>
                    @if (auth()->user()->roles == 'superadmin' || auth()->user()->roles == 'admin')
                        <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}" class="nav-link"><i
                                    class="fas fa-user-shield"></i><span>User List</span></a>
                        </li>
                    @endif
                </ul>
            </li>
            {{-- @if (auth()->user()->roles == 'superadmin' || auth()->user()->roles == 'admin')
                <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="nav-link "><i class="fas fa-users"></i><span>User
                            List</span></a>
                </li>
            @endif --}}
            <li class="nav-item">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="nav-link "><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="post">@csrf</form>
            </li>
    </aside>
</div>
