<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard.home') }}">
                    <i class="nav-icon icon-home"></i> {{ __('messages.home') }}
                </a>
            </li>


            {{-- Admins Links --}}
            @canany(['view admins', 'view roles'])
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-people"></i> {{ __('messages.users') }}</a>
                    <ul class="nav-dropdown-items">

                        @can('view admins')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.admins.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('messages.admins') }}</a>
                            </li>
                        @endcan
                        @can('view roles')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                    <i class="nav-icon fa fa-user-plus"></i> {{ __('messages.permissions') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany


        </ul>
    </nav>
</div>
