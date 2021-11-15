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
                    <a class="nav-main-link" href="{{ route('staff.dashboard') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.products') }}">
                        <i class="nav-main-link-icon fa fa-shopping-cart"></i>
                        <span class="nav-main-link-name">Products</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.appointments') }}">
                        <i class="nav-main-link-icon fa fa-calendar"></i>
                        <span class="nav-main-link-name">Appointments</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.appointments.list') }}">
                        <i class="nav-main-link-icon fa fa-list"></i>
                        <span class="nav-main-link-name">List Appointments</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.reminders') }}">
                        <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                        <span class="nav-main-link-name">Reminders</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.reports') }}">
                        <i class="nav-main-link-icon fa fa-file"></i>
                        <span class="nav-main-link-name">Reports</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.notification') }}">
                        <i class="nav-main-link-icon fa fa-bell"></i>
                        <span class="nav-main-link-name">Notifications</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.clients') }}">
                        <i class="nav-main-link-icon fa fa-users"></i>
                        <span class="nav-main-link-name">Clients</span>
                    </a>
                </li>
                @if(auth()->user()->role == 'ADMIN')
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.staffs') }}">
                        <i class="nav-main-link-icon fa fa-phone"></i>
                        <span class="nav-main-link-name">Staffs</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.admins') }}">
                        <i class="nav-main-link-icon fa fa-bolt"></i>
                        <span class="nav-main-link-name">Admins</span>
                    </a>
                </li>
                @endif
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.pets') }}">
                        <i class="nav-main-link-icon fa fa-dog"></i>
                        <span class="nav-main-link-name">Client Pets</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('staff.profile') }}">
                        <i class="nav-main-link-icon fa fa-user"></i>
                        <span class="nav-main-link-name">Profile</span>
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
   const navs=document.querySelectorAll(".nav-main > .nav-main-item > a"),currentUrl=window.location.href.split(/[?#]/)[0];for(nav of navs)nav.getAttribute("href")===currentUrl&&nav.classList.add("active");
</script>