<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="bi bi-house-door"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!-- Admin specific menu items -->
        @if (Auth::user()->role === 'admin')
            <!-- Appointments Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#appointments-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-calendar"></i><span>Appointments</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="appointments-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('appointments.index') }}">
                            <i class="bi bi-circle"></i><span>All Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('appointments.create') }}">
                            <i class="bi bi-circle"></i><span>Schedule New</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Appointment History</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Appointments Nav -->

            <!-- Services Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#services-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-tools"></i><span>Services</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="services-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('services.index') }}">
                            <i class="bi bi-circle"></i><span>Service List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services.create') }}">
                            <i class="bi bi-circle"></i><span>Add New Service</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Services Nav -->

            <!-- Clients Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#clients-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-lines-fill"></i><span>Clients</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="clients-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('clients.index') }}">
                            <i class="bi bi-circle"></i><span>Client List</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Add New Client</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Client Appointments</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Clients Nav -->

        @elseif (Auth::user()->role === 'customer')
            <!-- Customer specific menu items -->
            <!-- Appointments Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#appointments-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-calendar"></i><span>Appointments</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="appointments-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('appointments.index') }}">
                            <i class="bi bi-circle"></i><span>My Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('appointments.create') }}">
                            <i class="bi bi-circle"></i><span>Schedule New</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Appointments Nav -->
        @endif

        <!-- Logout Nav -->
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li><!-- End Logout Nav -->

    </ul>

</aside><!-- End Sidebar -->
