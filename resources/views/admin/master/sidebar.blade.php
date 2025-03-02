<aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="index3.html" class="brand-link">
                <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light text-center">
            </span>
            </a>

            <a href="#" class="brand-link">
                <a href="" class="brand-link">
                    <img src=""  class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light"></span>
                </a>
            </a>

        <a href="#" class="brand-link">
            <a href="{{route('home')}}" class="brand-link">
                <img src="" alt="" class="brand-image img-circle elevation-3" >
                <span class="brand-text font-weight-light">Amder Dokan</span>
            </a>
        </a>

<!-- Dynamic With Setting Company End-->
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth()->user()->name??'Super Admin'}}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt" style="color:#fa79ba"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list" style="color:#fa79ba"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i> <!-- Arrow indicator for submenu -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('categories.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Category</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
