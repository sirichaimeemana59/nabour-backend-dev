<nav class="navbar user-info-navbar mobile-is-visible"  role="navigation"><!-- User Info, Notifications and Menu Bar -->
    <!-- Left links for user info navbar -->
    <ul class="user-info-menu left-links list-inline list-unstyled">
        <li class="hide-small">
            <a href="#" data-toggle="sidebar" id="toggle-menu">
                <i class="fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right links for user info navbar -->
    <ul class="user-info-menu right-links list-inline list-unstyled">
        <li class="dropdown user-profile">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if(Auth::user()->profile_pic_name)
                <img src="{{ env('URL_S3') . "/profile-img/" . Auth::user()->profile_pic_path . Auth::user()->profile_pic_name }}" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                @else
                <img src="{{ url('/') }}/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                @endif
                <span>
                    {{ Auth::user()->name }}
                    <i class="fa-angle-down"></i>
                </span>
            </a>
            @include('menu-layouts.header-menu')
        </li>
    </ul>
</nav>