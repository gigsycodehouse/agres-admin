<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/image/logo/agres-id-logo-white.png')}}" alt="AdminLTE Logo" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Agres.id</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div> --}}
            <div class="info w-100 text-center">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('member.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Member</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('member_address.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Member Address</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('homepage_banner.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Homepage Banner</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('homepage_bottom_menu.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Homepage Bottom Menu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('homepage_top_menu.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Homepage Top Menu</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
