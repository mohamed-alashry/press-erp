<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard.home') }}">
                    <i class="nav-icon icon-home"></i> {{ __('lang.home') }}
                </a>
            </li>


            {{-- Admins Links --}}
            @canany(['view admins', 'view roles'])
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-people"></i> {{ __('lang.users') }}</a>
                    <ul class="nav-dropdown-items">

                        @can('view admins')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.admins.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.admins') }}</a>
                            </li>
                        @endcan
                        @can('view roles')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                    <i class="nav-icon fa fa-user-plus"></i> {{ __('lang.permissions') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            {{-- Clients Links --}}
            @canany(['view colors', 'view clients', 'view orders', 'view clientPayments'])
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-people"></i> {{ __('lang.clients') }}</a>
                    <ul class="nav-dropdown-items">

                        @can('view colors')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.colors.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.colors') }}</a>
                            </li>
                        @endcan
                        @can('view clients')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.clients.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.clients') }}</a>
                            </li>
                        @endcan
                        @can('view orders')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.orders.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.orders') }}</a>
                            </li>
                        @endcan
                        @can('view clientPayments')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.clientPayments.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.client_payments') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany


        </ul>
    </nav>
</div>
