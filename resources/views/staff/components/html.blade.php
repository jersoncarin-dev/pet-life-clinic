<!doctype html>
<html lang="en">
@include('components.head')
<body>
    @hasSection('auth')
        <div id="page-container">
    @endif
    
    @sectionMissing('auth')
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    @endif

        @sectionMissing('auth')
            @include('staff.components.sidebar')
            @include('components.nav')
        @endif

        <main id="main-container">
            @hasSection('auth')
                @yield('auth')
            @endif

            @sectionMissing('auth')
                @yield('content')
            @endif
        </main>
        
        @sectionMissing('auth')
            @include('components.footer')
        @endif
    </div>
</body>
@include('components.scripts')
</html>