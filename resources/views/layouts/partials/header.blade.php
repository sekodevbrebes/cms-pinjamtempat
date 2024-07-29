<header class="pc-header">
    <div class="header-wrapper">
        <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse"><a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i
                            class="ti ti-menu-2"></i></a></li>
                <li class="pc-h-item pc-sidebar-popup"><a href="#" class="pc-head-link ms-0"
                        id="mobile-collapse"><i class="ti ti-menu-2"></i></a></li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item header-user-profile"><a
                        class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false"><img
                            src="{{ asset('/assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="#!" class="dropdown-item"><i class="ti ti-settings"></i>
                            <span>Settings</span> </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ti ti-power"></i><span>Logout</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </div>


                </li>
            </ul>
        </div>
    </div>
</header>
