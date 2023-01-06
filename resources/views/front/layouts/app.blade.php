<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Magazine &mdash; Free Fully Responsive HTML5 Bootstrap Template by FREEHTML5.co</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />


    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('front/favicon.ico')}}">
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic|Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <!-- Animate -->
    <link rel="stylesheet" href="{{ asset('front/css/animate.css')}}">
    <!-- Icomoon -->
    <link rel="stylesheet" href="{{ asset('front/css/icomoon.css')}}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{ asset('front/css/style.css')}}">


    <!-- Modernizr JS -->
    <script src="{{ asset('front/js/modernizr-2.6.2.min.js')}}"></script>


</head>

<body>

    <!-- END #fh5co-offcanvas -->
    <header id="fh5co-header">

        <div class="container-fluid">

            <div class="row">
                <ul class="fh5co-social">
                    @guest
                    @if (Route::has('login'))
                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    @endif
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">{{ __('register') }}</a></li>
                    @endif
                    @else
                    <li> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>


                    @endguest
                </ul>
                <div class="col-lg-12 col-md-12 text-center">
                    <h1 id="fh5co-logo"><a href="{{route('home')}}">Blogs </a></h1>
                </div>

            </div>

        </div>

    </header>
    <!-- END #fh5co-header -->
    @yield('content')

    <footer id="fh5co-footer">
        <p><small>&copy; 2016. Magazine Free HTML5. All Rights Reserverd. <br> Designed by <a href="http://freehtml5.co" target="_blank">FREEHTML5.co</a> Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a></small></p>
    </footer>



    <!-- jQuery -->
    <script src="{{ asset('front/js/jquery.min.js')}}"></script>
    <!-- jQuery Easing -->
    <script src="{{ asset('front/js/jquery.easing.1.3.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('front/js/bootstrap.min.js')}}"></script>
    <!-- Waypoints -->
    <script src="{{ asset('front/js/jquery.waypoints.min.js')}}"></script>
    <!-- Main JS -->
    <script src="{{ asset('front/js/main.js')}}"></script>

</body>

</html>