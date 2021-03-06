<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="/">
            <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide font-size-h5 tracking-wider">
                <img class="rounded-circle" src="/assets/media/icons/icon-48x48.png"> PET'S<span class="font-w400">LIFE</span>
            </span>
        </a>
        <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
            <i class="fa fa-fw fa-times"></i>
        </a>
        <!-- END Logo -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-heading">Main</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('client.dashboard') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('client.products') }}">
                        <i class="nav-main-link-icon fa fa-shopping-cart"></i>
                        <span class="nav-main-link-name">Products</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('client.appointments') }}">
                        <i class="nav-main-link-icon fa fa-calendar"></i>
                        <span class="nav-main-link-name">Appointments</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('client.reminders') }}">
                        <i class="nav-main-link-icon fa fa-bell"></i>
                        <span class="nav-main-link-name">Reminders</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('client.pets') }}">
                        <i class="nav-main-link-icon fa fa-dog"></i>
                        <span class="nav-main-link-name">Pets</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('profile') }}">
                        <i class="nav-main-link-icon fa fa-user"></i>
                        <span class="nav-main-link-name">Profile</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('about') }}">
                        <i class="nav-main-link-icon fa fa-info-circle"></i>
                        <span class="nav-main-link-name">About us</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->

<script>
    const navs = document.querySelectorAll(".nav-main > .nav-main-item > a"),
        currentUrl = window.location.href.split(/[?#]/)[0];
    for (nav of navs) nav.getAttribute("href") === currentUrl && nav.classList.add("active");
</script>