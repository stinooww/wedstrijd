<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" type="text/css"/>


    <link href="<?php echo asset('css/index.css')?>" media="all" rel="stylesheet" type="text/css"/>



    <title>Jupiler Game</title>


</head>
<body>


<div id="header">

    <div class="wrapper">
        <nav class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav-collapse ">
            <img src="{{ asset('images/logo-03.png')}}" id="logo" alt="logo Jupiler" class="img-responsive">
            <div id="wrapperMenu">


                <ul id="menu">

                    <li>
                        <a href="/home">Home</a>
                    </li>


                    <div id="login">
                        @if (Auth::check())
                            <li class="login">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Uitloggen
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li class="login">
                                <a href="{{ url('/login') }}">Login</a>
                            </li>
                            {{--<li class="login">--}}
                            {{--<a href="{{ url('/register') }}">Registreer</a>--}}
                            {{--</li>--}}
                        @endif
                    </div>
                    {{--<li>--}}
                    {{--Contact--}}
                    {{--</li>--}}
                    <div class="clearfix"></div>
                </ul>

            </div>
        </nav>
        <div class="clearfix"></div>
    </div>

</div>
@yield('content')
<footer>
    <p>2017 Jupiler wedstrijd | Privacy & gebruiksvoorwaarden</p>

    <div class="clearfix"></div>
</footer>

<script type="text/javascript" src="<?php echo asset('js/validatie.js')?>"></script>

</body>
</html>
