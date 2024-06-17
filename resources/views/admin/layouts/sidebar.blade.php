<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('admin/assets/img/logo.png') }}" class="mr-3" width="15%" alt="Kuba Logo" />Kuba
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('admin/assets/img/logo.png') }}" width="50%"
                    alt="Kuba Logo" /></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Transport Manager</li>
            <li><a class="nav-link" href="{{ route('admin.agencies.index') }}"><i
                        class='bx bxs-building'></i><span>Agency</span></a></li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class='bx bxs-bus'></i>
                    <span>Manage Fleets</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.seat_layouts.index') }}">Seat Layout</a></li>
                    <li><a class="nav-link" href="{{ route('admin.facilities.index') }}">Facilities</a></li>
                    <li><a class="nav-link" href="{{ route('admin.fleet_type.index') }}">Fleet Type</a></li>
                    <li><a class="nav-link" href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class='bx bxs-bus'></i>
                    <span>Manage Trips</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.route.index') }}">Route</a></li>
                    <li><a class="nav-link" href="{{ route('admin.schedule.index') }}">Schedule</a></li>
                    <li><a class="nav-link" href="{{ route('admin.ticket-price.index') }}">Ticket Price</a></li>
                    <li><a class="nav-link" href="{{ route('admin.trips.index') }}">Trip</a></li>
                    <li><a class="nav-link" href="{{ route('admin.assigned-vehicles.index') }}">Assign Vehicle</a></li>
                </ul>
            </li>
            {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="forms-advanced-form.html">Advanced Form</a></li>
                    <li><a class="nav-link" href="forms-editor.html">Editor</a></li>
                    <li><a class="nav-link" href="forms-validation.html">Validation</a></li>
                </ul>
            </li> --}}
        </ul>
    </aside>
</div>
