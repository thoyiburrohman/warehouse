<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('index') }}" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ asset('images/logo.png') }}" alt="" class="logo logo-sm" />
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="" class="logo logo-lg" style="width: 40px" />
                    <h3 class="ms-2 mt-2 mb-0 logo logo-lg text-primary">Warehouse</h3>
                </div>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>Main</label>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="nxl-item nxl-caption">
                    <label>NTE</label>
                </li>
                <li class="nxl-item {{ Request::is('nte/*') ? 'active' : '' }}">
                    <a href="{{ route('nte.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-home"></i></span>
                        <span class="nxl-mtext">Stock</span>
                    </a>
                </li>
                <li class="nxl-item {{ Request::is('distribution/nte/*') ? 'active' : '' }}">
                    <a href="{{ route('distribution.nte.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-corner-up-right"></i></span>
                        <span class="nxl-mtext">Distribution</span>
                    </a>
                </li>
                <li class="nxl-item {{ Request::is('tag-out/nte/*') ? 'active' : '' }}">
                    <a href="{{ route('tag-out.nte.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-log-out"></i></span>
                        <span class="nxl-mtext">Tag Out</span>
                    </a>
                </li>
                <li class="nxl-item {{ Request::is('tag-in/nte/*') ? 'active' : '' }}">
                    <a href="{{ route('tag-in.nte.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-log-in"></i></span>
                        <span class="nxl-mtext">Tag In</span>
                    </a>
                </li>
                <li class="nxl-item nxl-caption">
                    <label>Material</label>
                </li>
                <li class="nxl-item {{ Request::is('material/*') ? 'active' : '' }}">
                    <a href="{{ route('material.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-home"></i></span>
                        <span class="nxl-mtext">Stock</span>
                    </a>
                </li>
                <li class="nxl-item {{ Request::is('distribution/material/*') ? 'active' : '' }}">
                    <a href="{{ route('distribution.material.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-corner-up-right"></i></span>
                        <span class="nxl-mtext">Distribution</span>
                    </a>
                </li>
                <li class="nxl-item {{ Request::is('tag-out/material/*') ? 'active' : '' }}">
                    <a href="{{ route('tag-out.material.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-log-out"></i></span>
                        <span class="nxl-mtext">Tag Out</span>
                    </a>
                </li>
                <li class="nxl-item {{ Request::is('tag-in/material/*') ? 'active' : '' }}">
                    <a href="{{ route('tag-in.material.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-log-in"></i></span>
                        <span class="nxl-mtext">Tag In</span>
                    </a>
                </li>
                <li class="nxl-item nxl-caption">
                    <label>System</label>
                </li>
                <li
                    class="nxl-item nxl-hasmenu {{ Request::is('asset-nte/*', 'asset-material/*') ? 'active nxl-trigger' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-list"></i></span>
                        <span class="nxl-mtext">Asset</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item {{ Request::is('asset-nte/*') ? 'active' : '' }}"><a class="nxl-link"
                                href="{{ route('asset-nte.index') }}">NTE</a></li>
                        <li class="nxl-item {{ Request::is('asset-material/*') ? 'active' : '' }}"><a class="nxl-link"
                                href="{{ route('asset-material.index') }}">Material</a>
                        </li>
                    </ul>
                </li>

                <li class="nxl-item">
                    <a href="{{ route('mitra.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">Mitra</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('technician.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">Teknisi</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('user.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">User</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
