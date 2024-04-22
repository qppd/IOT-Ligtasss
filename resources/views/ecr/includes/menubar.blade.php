<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/ecr/dashboard') }}" class="brand-link">
        <img src="{{ url('storage/images/login-logo.png') }}" alt="Ligtasss" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Ligtasss</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <br>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('/ecr/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- Dashboard -->

                <!-- Camera -->
                <li class="nav-item">
                    <a href="{{ url('/ecr/cameras') }}" class="nav-link">
                        <i class="nav-icon fas fa-camera"></i>
                        <p>
                            Cameras
                        </p>
                    </a>
                </li>
                <!-- Camera -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
