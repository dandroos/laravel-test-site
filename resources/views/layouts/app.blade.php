<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('subtitle')@yield('title') | Bridal Elegance</title>
</head>
<body>
    <nav>
        <div>
            <h1>Bridal Elegance</h1>
        </div>
        <div>
            <ul>
                <li><a href="/news">Home</a></li>
                <li><a href="/collections">Collections</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
            <ul>
            @if (Auth::check())
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
                <li>
                    <a href="#">Facebook</a>
                </li>
                <li>
                    <a href="#">Twitter</a>
                </li>
                <li>
                    <a href="#">Instagram</a>
                </li>
            </ul>
        </div>
    </nav>
    <div>
        @yield('content')
    </div>
@if (!Auth::check())
    <a href="{{ route('login') }}">Login</a>
@endif
    <div>
        All content &copy; 2019 Bridal Elegance.  Site created by dandroos.
    </div>
    
</body>
</html>