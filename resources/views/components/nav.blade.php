 <!-- Header -->
 <header id="page-header">
     <!-- Header Content -->
     <div class="content-header">
         <!-- Left Section -->
         <div class="d-flex align-items-center">
             <!-- Toggle Sidebar -->
             <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
             <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                 <i class="fa fa-fw fa-bars"></i>
             </button>
             <!-- END Toggle Sidebar -->

             <!-- Toggle Mini Sidebar -->
             <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                 <i class="fa fa-fw fa-ellipsis-v"></i>
             </button>
             <!-- END Toggle Mini Sidebar -->
         </div>
         <!-- END Left Section -->

         <!-- Right Section -->
         <div class="d-flex align-items-center">
             <!-- User Dropdown -->
             <div class="dropdown d-inline-block ml-2">
                 <button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img class="rounded-circle" src="{{ auth()->user()->detail->avatar }}" alt="Header Avatar" style="width: 21px;">
                     <span class="d-none d-sm-inline-block ml-2">{{ strtok(trim(auth()->user()->name),' ') }}</span>
                     <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
                     <div class="p-3 text-center bg-primary-dark rounded-top">
                         <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ auth()->user()->detail->avatar }}" alt="{{ strtok(trim(auth()->user()->name),' ') }}">
                         <p class="mt-2 mb-0 text-white font-w500">{{ strtok(trim(auth()->user()->name),' ') }}</p>
                         <p class="mb-0 text-white-50 font-size-sm">{{ auth()->user()->role }}</p>
                     </div>
                     <div class="p-2">
                         <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('profile') }}">
                             <span class="font-size-sm font-w500">My Profile</span>
                         </a>
                         <div role="separator" class="dropdown-divider"></div>
                         <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}">
                             <span class="font-size-sm font-w500">Log Out</span>
                         </a>
                     </div>
                 </div>
             </div>
             <!-- END User Dropdown -->

             <!-- Notifications Dropdown -->
             <div class="dropdown d-inline-block ml-2">
                 <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="text-primary nodis notif-dot" id="notification-dot">•</span>
                 </button>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">
                     <div class="p-2 bg-primary-dark text-center rounded-top">
                         <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>
                     </div>
                     <ul class="nav-items mb-0" id="notification-list">
                        @foreach(\App\Models\Reminder::where('user_id',Auth::id())->latest()->take(6)->get() as $reminder)
                            <li>
                                <a class="text-dark media py-2" href="{{ $reminder->link }}">
                                    <div class="mr-2 ml-3">
                                        <i class="fa fa-fw fa-bell {{ $reminder->is_read ? 'text-success' : '' }}"></i>
                                    </div>
                                    <div class="media-body pr-2">
                                        <div class="font-w600">{{ $reminder->title }}</div>
                                        <span class="font-w500 text-muted">{{ $reminder->created_at->diffForHumans() }}</span>
                                    </div>
                                </a>
                            </li>
                         @endforeach
                     </ul>
                     <div class="p-2 border-top">
                         <a class="btn btn-sm btn-light btn-block text-center" href="{{ route('client.reminders') }}">
                             <i class="fa fa-fw fa-arrow-down mr-1"></i> LOAD ALL
                         </a>
                     </div>
                 </div>
             </div>
         </div>
         <!-- END Right Section -->
     </div>
     <!-- END Header Content -->
 </header>