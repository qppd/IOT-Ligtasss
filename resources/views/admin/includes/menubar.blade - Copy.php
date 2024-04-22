<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/ecr/dashboard') }}" class="brand-link">
        <img src="{{ url('storage/images/login-logo.png') }}" alt="IOT Ligtas" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">IOT Ligtas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <br>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Dashboard -->

                <li class="nav-item">
                    <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- Dashboard -->

                <!-- Employees -->
                <li class="nav-item">
                    <a href="{{ url('/admin/employees') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Employees
                        </p>
                    </a>
                </li>
                <!-- Employees -->


                <!-- Student -->
                <li class="nav-item">
                    <a href="{{ url('/admin/students') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Students
                        </p>
                    </a>
                </li>
                <!-- Student -->

                <!-- Camera -->
                <li class="nav-item">
                    <a href="{{ url('/admin/cameras') }}" class="nav-link">
                        <i class="nav-icon fas fa-camera"></i>
                        <p>
                            Cameras
                        </p>
                    </a>
                </li>
                <!-- Camera -->

                <!-- Smart Gate -->
                <li class="nav-item">
                    <a href="{{ url('/ecr/gate') }}" class="nav-link">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>
                            Smart Gate
                        </p>
                    </a>
                </li>
                <!-- Smart Gate -->

                <!-- Smart Rooms -->
                <li class="nav-item">
                    <a href="{{ url('/ecr/rooms') }}" class="nav-link">
                        <i class="nav-icon fas fa-door-closed"></i>
                        <p>
                            Smart Rooms
                        </p>
                    </a>
                </li>
                <!-- Smart Rooms -->

                <!-- Attendance Monitoring -->
                <li class="nav-item">
                    <a href="{{ url('/ecr/attendance') }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-user"></i>
                        <p>
                            Attendance Monitoring
                        </p>
                    </a>
                </li>
                <!-- Attendance Monitoring -->

                <!-- Fire Alarm -->
                <li class="nav-item">
                    <a href="{{ url('/ecr/fire') }}" class="nav-link">
                        <i class="nav-icon fas fa-fire"></i>
                        <p>
                            Fire Detection Modules
                        </p>
                    </a>
                </li>
                <!-- Fire Alarm -->



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
