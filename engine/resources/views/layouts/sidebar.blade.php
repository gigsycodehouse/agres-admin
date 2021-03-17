<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link text-center">
        {{-- <img src="{{asset('assets/image/logo/agres-id-logo-white.png')}}" alt="AdminLTE Logo" class="brand-image"
        style="opacity: .8"> --}}
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
                    <a href="{{url('/')}}" class="nav-link pl-unset">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link pl-unset">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('blast_email.index')}}" class="nav-link pl-unset">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Blast Email</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link pl-unset">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Member
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('member.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Verified Member</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('member.unverified')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Unverified Member</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('member_address.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Member Address</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('member_request.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Member Request</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link pl-unset">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            CMS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link pl-unset" style="padding-left: 2rem">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Homepage
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="padding-left: 1rem">
                                <li class="nav-item">
                                    <a href="{{route('homepage_banner.index')}}" class="nav-link pl-unset">
                                        <i class="nav-icon fas caret-right"></i>
                                        <p>Homepage Banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('homepage_promo_banner.index')}}" class="nav-link pl-unset">
                                        <i class="nav-icon fas caret-right"></i>
                                        <p>Homepage Promo Banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('homepage_bottom_menu.index')}}" class="nav-link pl-unset">
                                        <i class="nav-icon fas caret-right"></i>
                                        <p>Homepage Bottom Menu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('homepage_top_menu.index')}}" class="nav-link pl-unset">
                                        <i class="nav-icon fas caret-right"></i>
                                        <p>Homepage Top Menu</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link pl-unset" style="padding-left: 2rem">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Category Catalog
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="padding-left: 1rem">
                                <li class="nav-item">
                                    <a href="{{route('catalog_banner.index')}}" class="nav-link pl-unset">
                                        <i class="nav-icon fas caret-right"></i>
                                        <p>Banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('catalog_promo_banner.index')}}" class="nav-link pl-unset">
                                        <i class="nav-icon fas caret-right"></i>
                                        <p>Promo Menarik Banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('catalog_special_banner.index')}}" class="nav-link pl-unset">
                                        <i class="nav-icon fas caret-right"></i>
                                        <p>Special Deal Banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('catalog_brand.index')}}" class="nav-link pl-unset">
                                        <i class="nav-icon fas caret-right"></i>
                                        <p>Brand Icon</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link pl-unset">
                        <i class="nav-icon fas fa-laptop"></i>
                        <p>
                            Product
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('category.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-laptop"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('sub_category.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-laptop"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('item.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-laptop"></i>
                                <p>Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('item_hot.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-laptop"></i>
                                <p>Product Hot Section</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('item_select.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-laptop"></i>
                                <p>Product Pilihan Section</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('item_best.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-laptop"></i>
                                <p>Product Best Seller Section</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('item_newest.index')}}" class="nav-link pl-unset">
                                <i class="nav-icon fas fa-laptop"></i>
                                <p>Product Newest Section</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
