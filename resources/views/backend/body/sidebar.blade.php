<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="index.html" class="tp-link">Analytical</a>
                            </li>
                            <li>
                                <a href="ecommerce.html" class="tp-link">E-commerce</a>
                            </li>
                        </ul>
                    </div>
                </li>
    
                <!-- <li>
                    <a href="landing.html" target="_blank">
                        <i data-feather="globe"></i>
                        <span> Landing </span>
                    </a>
                </li> -->

                <li class="menu-title">Pages</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> کارمندان </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.employee') }}" class="tp-link">لیست کارمندان </a>
                            </li>
                            <li>
                                <a href="{{ route('add.employee') }}" class="tp-link">افزودن کارمند</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#category" data-bs-toggle="collapse">
                        <i data-feather="package"></i>
                        <span> دسته بندی محصولات </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.category') }}" class="tp-link">لیست دسته بندی ها</a>
                            </li>
                            <li>
                                <a href="{{ route('add.category') }}" class="tp-link">افزودن دسته بندی</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#product" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> محصولات </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.products') }}" class="tp-link">لیست محصولات</a>
                            </li>
                            <li>
                                <a href="{{ route('add.products') }}" class="tp-link">افزودن محصول</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sales" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> فروشات </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sales">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.sales') }}" class="tp-link">لیست فروشات</a>
                            </li>
                            <li>
                                <a href="{{ route('add.sales') }}" class="tp-link">افزودن فروشات</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#charges" data-bs-toggle="collapse">
                        <i data-feather="bar-chart-2"></i>
                        <span> مصارف </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="charges">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.expenses') }}" class="tp-link">لیست مصارف</a>
                            </li>

                            <li>
                                <a href="{{ route('add.expenses') }}" class="tp-link">افزودن مصرف</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- report --}}

                        <li>
                    <a href="#reports" data-bs-toggle="collapse">
                        <i data-feather="bar-chart-2"></i>
                        <span> گذارشات </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="reports">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.expenses.report') }}" class="tp-link">گذارش مصارفات</a>
                            </li>
                            <li>
                                <a href="{{ route('all.report') }}" class="tp-link">گذارشات عمومی</a>
                            </li>                          
                        </ul>
                    </div>
                </li>


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>