<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery1.9.1.min.js')}}"></script>
    <script src="{{ asset('js/sweetalert.min.js')}}"></script>
    <script src="{{ asset('js/boxicons.js')}}"></script>


    <title>Sri Hari Traders</title>
    <style>
        body{
            background-color: #f4f7fc;

        }
        .dev{
            position: fixed;
            height: 100vh;
            width: 10vh;
            background-color:white;
            -webkit-box-shadow: 10px 10px 5px -4px rgb(226, 226, 226);
-moz-box-shadow: 10px 10px 5px -4px rgb(226, 226, 226);
box-shadow: 10px 10px 5px -4px rgb(226, 226, 226);
        }
        .wrapper{
            display: flex;
        }
        .ico-list{
            height: 35vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logout{
            margin-top: 45vh;
        }
        .mcol-1{
            flex: 0 0 8.3333333333%;
            max-width: 4.333333%;
            padding: 0;
        }
        .col-12{
            flex: 0 0 100%;
            max-width: 95%;
            padding-left: 15px;
            padding-right: 0px;
        }
    </style>

</head>
<body>

    <div class="wrapper">
        <div class="mcol-1">
    <div class="dev">
        <ul class="nav flex-column ico-list">
            <li class="nav-item">
            <a class="nav-link active" href="/home"><img src="{{asset('images/dashboard-solid-24.png')}}" alt="" srcset=""></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/stocks"><img src="{{asset('images/cube-solid-24.png')}}" alt="" srcset=""></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/customer"><img src="{{asset('images/user-solid-24.png')}}" alt="" srcset=""></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/bill"><img src="{{asset('images/receipt-solid-24.png')}}" alt="" srcset=""></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item logout">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                         <img src="{{asset('images/log-out-regular-24.png')}}" alt="" srcset="">
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                </li>
            @endguest
        </ul>
    </div>
</div>
    <div class="col-12">@yield('content')</div>
</div>
</body>
</html>
