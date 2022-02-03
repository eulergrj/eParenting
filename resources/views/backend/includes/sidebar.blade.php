<ul>
    <li class="header-menu">General</li>
    <li class="{{activeClass(Route::is('admin.dashboard'), 'active-page-link')}}">
        <a href="{{route('admin.dashboard')}}">
            <i class="icon-devices_other"></i>
            <span class="menu-text">Dashboard</span>
        </a>
    </li>
    <li class="{{activeClass(Route::is('admin.viewHistory'), 'active-page-link')}}">
        <a href="{{route('admin.viewHistory')}}">
            <i class="icon-play"></i>
            <span class="menu-text">Viewing History</span>
        </a>
    </li>       
    <li class="{{activeClass(Route::is('admin.familyMembers'), 'active-page-link')}}">
        <a href="{{route('admin.familyMembers')}}">
            <i class="icon-users"></i>
            <span class="menu-text">Family Members</span>
        </a>
    </li>

    

   
   
    <li class="header-menu">ADMIN</li>
    <li class="header-menu">Location</li>
    <li class="{{activeClass(Route::is('admin.countries'), 'active-page-link')}}">
        <a href="{{route('admin.countries')}}">
            <i class="icon-globe"></i>
            <span class="menu-text">Countries</span>
        </a>
    </li>
    <!-- <li class="{{activeClass(Route::is('admin.countries'), 'active-page-link')}}">
        <a href="{{route('admin.countries')}}">
            <i class="icon-globe"></i>
            <span class="menu-text">Counties</span>
        </a>
    </li> -->
    <!-- <li class="{{activeClass(Route::is('admin.countries'), 'active-page-link')}}">
        <a href="{{route('admin.countries')}}">
            <i class="icon-globe"></i>
            <span class="menu-text">Towns</span>
        </a>
    </li> -->

    

    @if (
        $logged_in_user->hasAllAccess() ||
        (
            $logged_in_user->can('admin.access.user.list') ||
            $logged_in_user->can('admin.access.user.deactivate') ||
            $logged_in_user->can('admin.access.user.reactivate') ||
            $logged_in_user->can('admin.access.user.clear-session') ||
            $logged_in_user->can('admin.access.user.impersonate') ||
            $logged_in_user->can('admin.access.user.change-password')
        )
    )                        
        <!-- System menus -->
        <li class="header-menu">System</li>
        <li class="sidebar-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'active') }}">
            <a href="#">
                <i class="icon-users"></i>
                <span class="menu-text">Access</span>
            </a>
            <div class="sidebar-submenu">
                <ul>
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li>
                            <a href="{{route('admin.auth.user.index')}}" class="{{activeClass(Route::is('admin.auth.user.*'), 'current-page')}}">User Management</a>
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li>
                            <a href="{{route('admin.auth.role.index')}}" class="{{activeClass(Route::is('admin.auth.role.*'), 'current-page')}}">Role Management</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif

    @if ($logged_in_user->hasAllAccess())
        <li class="sidebar-dropdown">
            <a href="#">
                <i class="icon-timeline"></i>
                <span class="menu-text">Logs</span>
            </a>
            <div class="sidebar-submenu">
                <ul>
                    <li><a href="{{route('log-viewer::dashboard')}}" target="_blank">Dashboard</a></li>
                    <li><a href="{{route('log-viewer::logs.list')}}" target="_blank">Logs</a></li>
                </ul>
            </div>
        </li>
    @endif
</ul>  