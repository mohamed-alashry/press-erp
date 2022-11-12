@php
    $nav = $dir == 'ltr' ? 'ml-auto' : 'mr-auto';
    $dropdown = $dir == 'ltr' ? 'dropdown-menu-right' : 'dropdown-menu-left';
@endphp
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('admin.dashboard.home') }}">
        <img class="d-md-down-none" src="{{ asset($locale == 'ar' ? 'img/logo.png' : 'img/logo.png') }}" height="25"
            alt="Ashry">
        {{-- <img class="d-md-down-none" src="{{ asset($locale == 'ar' ? 'img/logo-dash-rtl.png' : 'img/logo-dash-ltr.png') }}" height="25" alt="Ashry"> --}}
        <img class="d-lg-none" src="{{ asset('img/logo.png') }}" height="30" alt="Ashry">
    </a>

    {{-- URLs --}}

    <ul class="nav navbar-nav d-md-down-none">


    </ul>

    <ul class="nav navbar-nav {{ $nav }}">
        {{-- <li class="nav-item d-md-down-none">
            @php
                $NotLocale = $locale == 'ar' ? 'en' : 'ar';
            @endphp
            <a class="nav-link"
                href="{{ str_replace(env('REDIRECT') . '/' . $locale, env('REDIRECT') . '/' . $NotLocale, url()->full()) }}">
                <i class="icon-globe"></i>
                {{ __('lang.' . $NotLocale . '-inverse') }}
            </a>
        </li> --}}
        {{-- <li class="nav-item dropdown d-md-down-none">
      <a class="nav-link px-2" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-language"></i> {{ __('lang.'. $locale) }}</a>
      <div class="dropdown-menu {{ $dropdown }}">

        @foreach ($langs as $lang)
          <a class="dropdown-item" href="{{ str_replace(env('REDIRECT') .'/'. $locale, env('REDIRECT') .'/'. $lang->locale , url()->full()) }}">
            {{ __('lang.'. $lang->locale) }}
          </a>
        @endforeach
      </div>
    </li> --}}

        <li class="nav-item dropdown">
            <a class="nav-link px-2" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="nav-icon icon-user"></i>
            </a>
            <div class="dropdown-menu {{ $dropdown }}">
                <div class="dropdown-header text-center">
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
                <a class="dropdown-item" href="{{ route('admin.admins.show', auth()->id()) }}">
                    <i class="fa fa-user"></i> {{ __('lang.profile') }}</a>
                <a class="dropdown-item" href="{{ route('admin.auth.logout') }}">
                    <i class="fa fa-lock"></i> {{ __('lang.logout') }}</a>
            </div>
        </li>
    </ul>
</header>
