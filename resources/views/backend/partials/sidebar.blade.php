<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ route("admin.dashboard") }}" class="navbar-brand mx-4 mb-3">
            <img src="/meherabmain.png" alt="meherab" width="200px">
        </a>
        <div class="navbar-nav w-100">
            <a href="index.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('about') }}" class="nav-item nav-link"><i class="fa fa-info-circle me-2"></i>About</a>
            <a href="{{ route('experiences.index') }}" class="nav-item nav-link"><i class="fa fa-briefcase me-2"></i>Experiences</a>
            <a href="{{ route('educations.index') }}" class="nav-item nav-link"><i class="mdi mdi-school-outline me-2"></i>Education</a>

            <!-- Skills Dropdown Menu -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-trophy me-2"></i>Skills</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('skills.index') }}" class="dropdown-item">Manage Skills</a>
                    <a href="{{ route('skills.category.create') }}" class="dropdown-item">Add New Category</a>
                    <a href="{{ route('skills.skill.create') }}" class="dropdown-item">Add New Skill</a>
                </div>
            </div>

            <a href="{{ route('projects.index') }}" class="nav-item nav-link"><i class="mdi mdi-file-multiple me-2"></i>Projects</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="mdi mdi-post-outline me-2"></i>Blogs</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('blogs.index') }}" class="dropdown-item">Manage Blogs</a>
                    <a href="{{ route('blogs.create') }}" class="dropdown-item">Create New Blog</a>
                </div>
            </div>
        </div>
    </nav>
</div>
