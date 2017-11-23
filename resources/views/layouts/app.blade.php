@include('partials._header')
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="MKOO logo" height="30px" class="pull-left">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li {{ is_active_route('home') }}>
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li {{ is_active_route('meals') }}>
                            <a href="{{ route('meals.index') }}">Meals</a>
                        </li>
                        <li {{ is_active_route('items') }}>
                            <a href="{{ route('items.index') }}">Items</a>
                        </li>
                        <li {{ is_active_route('menu') }}><a href="{{ route('menu.index') }}">Menu</a></li>
                        <li {{ is_active_route('orders') }}>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Orders <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('orders.create') }}">Add order</a></li>
                                <li><a href="{{ route('orders.index') }}">View all</a></li>
                            </ul>
                        </li>

                        <li {{ is_active_route('users.index') }}><a href="{{route('users.index')}}">Users</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ auth()->user()->getFullName() }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
								<li>
									<a href="#">Notification</a>
								</li>

								<li>
									<a href="#">Settings</a>
								</li>

                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @if(in_array(request()->route()->getName(), ['orders.create']))
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>@yield('title')</h1>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-md-6">
                    <h1>@yield('title')</h1>
                </div>
                <div class="col-md-6" style="margin-top: 15px;">
                    <div class="btn-group pull-right" role="group" aria-label="...">
                        @yield('page-actions')
                    </div>
                </div>
            </div>
            @endif

            @include('flash::message')

        </div>

        @yield('content')
    </div>
@push('more_scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
@include('partials._footer')
