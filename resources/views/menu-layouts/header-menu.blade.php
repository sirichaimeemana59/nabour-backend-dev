<ul class="dropdown-menu user-profile-menu list-unstyled">
    <li>
        <a href="{!! url('settings') !!}">
            <i class="fa-user"></i> {!! __('messages.Settings.profile_settings') !!}
        </a>
    </li>
    <li class="last">
        <a href="{!! url('auth/logout') !!}">
            <i class="fa-lock"></i> {!! __('messages.Auth.logout') !!}
        </a>
    </li>
</ul>