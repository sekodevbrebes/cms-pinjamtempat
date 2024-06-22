<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header"><a href="#"
                class="b-brand text-primary"><!-- ========   Change your logo from here   ============ --> <img
                    src="{{ asset('/assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo">
                <span class="badge bg-light-success rounded-pill ms-2 theme-version">V.1.0</span></a></div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption"><label>Navigation</label></li>
                {{-- <li class="pc-item pc-hasmenu"><a href="#!" class="pc-link">
                        <span class="pc-micon"><svg class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg> </span><span class="pc-mtext">Dashboard</span> <span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span> </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="../dashboard/index.html">Default</a></li>

                    </ul>
                </li> --}}

                <li class="pc-item pc-hasmenu"><a href="#!" class="pc-link">
                        <span class="pc-micon"><svg class="pc-icon">
                                <use xlink:href="#custom-document"></use>
                            </svg> </span><span class="pc-mtext">Agenda</span>
                        </span>
                    </a>

                </li>

                {{-- <li class="pc-item pc-caption"><label>Widget</label> <svg class="pc-icon">
                        <use xlink:href="#custom-presentation-chart"></use>
                    </svg></li> --}}
                <li class="pc-item">
                    <a href="{{ route('rooms.index') }}" class="pc-link"><span class="pc-micon"><svg class="pc-icon">
                                <use xlink:href="#custom-fatrows"></use>
                            </svg> </span><span class="pc-mtext">Tempat</span></a>
                </li>
                <li class="pc-item"><a href="{{ route('users.index') }}" class="pc-link"><span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-user-square"></use>
                            </svg> </span><span class="pc-mtext">Users</span></a></li>

                {{-- <li class="pc-item"><a href="../widget/w_chart.html" class="pc-link"><span class="pc-micon"><svg
                                class="pc-icon">
                                <use xlink:href="#custom-presentation-chart"></use>
                            </svg> </span><span class="pc-mtext">Chart</span></a></li> --}}

            </ul>
        </div>
    </div>
</nav>
