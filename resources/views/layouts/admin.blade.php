<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ECD Platform - @yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-light bg-faded">
        <a class="navbar-brand" href="{{ URL::route('home') }}"><img id="logo" src="{{ asset('img/logo.png') }}" alt="ECD Platform" title="ECD Platform"/></a>
        <ul class="nav navbar-nav">

            @if(Auth::check())

            @if(Auth::user()->isAdmin() || Auth:user()->isPractitioner())
                <li class="nav-item">
                    {!! link_to_route('centre.index', "Centres", [], ['class' => 'nav-link']) !!}
                </li>

                <li class="nav-item">
                    {!! link_to_route('staff.index', "Staff", [], ['class' => 'nav-link']) !!}
                </li>

                <li class="nav-item">
                    {!! link_to_route('centreClass.index', "Classes", [], ['class' => 'nav-link']) !!}
                </li>

                <li class="nav-item">
                    {!! link_to_route('child.index', "Children", [], ['class' => 'nav-link']) !!}
                </li>

                <li class="nav-item">
                    {!! link_to_route('childAttendance.index', "Attendance", [], ['class' => 'nav-link']) !!}
                </li>
                <li class="nav-item">
                    {!! link_to_route('files.index', "Files", [], ['class' => 'nav-link']) !!}
                </li>
            @endif

                <li class="nav-item float-xs-right">
                    {!! link_to_route('logout', "Logout", [], ['class' => 'nav-link']) !!}
                </li>
            @if(Auth::user()->isAdmin())
                <li class="nav-item float-xs-right">
                    {!! link_to_route('admin.index', "Admin", [], ['class' => 'nav-link']) !!}
                </li>
                <li class="nav-item dropdown float-xs-right">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">External</a>
                    <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
                        {!! link_to_route('externalUser.index', "User", [], ['class' => 'dropdown-item']) !!}
                        {!! link_to_route('externalApiUser.index', "API User", [], ['class' => 'dropdown-item']) !!}
                    </div>
                </li>
            @endif
        @else
            <li class="nav-item float-xs-right">
                {!! link_to_route('getLogin', "Login", [], ['class' => 'nav-link']) !!}
            </li>
        @endif
        </ul>
    </nav>
    <div class="container">
        @include('partials.notifications')

        @yield('content')
    </div>
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/js/tether.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

@yield('scripts')
</body>
</html>
