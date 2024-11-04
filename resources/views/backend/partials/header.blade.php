<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <div class="d-flex align-items-center">
        <!-- Sidebar Toggle -->
        <a href="#" class="sidebar-toggler flex-shrink-0 me-3">
            <i class="fa fa-bars"></i>
        </a>

        <!-- Home Button -->
        <a href="{{ route('home') }}" class="btn btn-primary d-flex align-items-center" target="_blank">
            <i class="fa fa-home me-2"></i> Home
        </a>
    </div>

    <!-- Search Bar -->
    <form class="d-none d-md-flex ms-4 flex-grow-1">
        <input class="form-control bg-dark border-0" type="search" placeholder="Search">
    </form>

    <!-- Right-side Navbar Items -->
    <div class="navbar-nav align-items-center ms-auto">
        <!-- Messages Dropdown -->
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-envelope me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Message</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item text-center">See all messages</a>
            </div>
        </div>

        <!-- Notifications Dropdown -->
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notifications</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="{{ asset(Auth::user()->profile_picture) }}" alt="" style="width: auto; height: 40px;">
                <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="{{ route("profile.index") }}" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
                <a href="{{ route('admin.logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>

