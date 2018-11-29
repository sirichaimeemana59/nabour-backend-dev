<ul class="dropdown-menu user-profile-menu list-unstyled">
    <li>
        <a href="{{url('settings')}}">
            <i class="fa-user"></i> {{trans('messages.Settings.profile_settings')}}
        </a>
    </li>
    <li class="last">
        <a href="{{ url('auth/logout') }}">
            <i class="fa-lock"></i> {{trans('messages.Auth.logout')}}
        </a>
    </li>
</ul>