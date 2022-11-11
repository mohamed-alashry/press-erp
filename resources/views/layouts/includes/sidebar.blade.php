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

            {{-- Suppliers Links --}}
            @canany(['view suppliers', 'view supplies', 'view supplierPayments'])
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-people"></i> {{ __('lang.suppliers') }}</a>
                    <ul class="nav-dropdown-items">

                        @can('view suppliers')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.suppliers.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.suppliers') }}</a>
                            </li>
                        @endcan
                        @can('view supplies')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.supplies.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.supplies') }}</a>
                            </li>
                        @endcan
                        @can('view supplierPayments')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.supplierPayments.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.supplier_payments') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            {{-- Financial Links --}}
            @canany(['view expenses', 'view supplies', 'view supplierPayments'])
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-people"></i> {{ __('lang.financial') }}</a>
                    <ul class="nav-dropdown-items">

                        @can('view expenses')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.expenses.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.expenses') }}</a>
                            </li>
                        @endcan
                        @can('view supplies')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.supplies.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.supplies') }}</a>
                            </li>
                        @endcan
                        @can('view supplierPayments')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.supplierPayments.index') }}">
                                    <i class="nav-icon icon-people"></i> {{ __('lang.supplier_payments') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany


        </ul>
    </nav>
</div>
