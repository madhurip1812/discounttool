<!doctype html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--     <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}"> -->
    <link rel="stylesheet" href="{{asset('assets/vendor/linearicons/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/chartist/css/chartist-custom.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- select2 -->
    <link href="{{asset('assets/vendor/select2/dist/css/select2.min.css')}}" rel='stylesheet' type='text/css'>
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/fc_favicon.ico')}}">
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/fontawesome/944cc5f91a.js')}}"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="index.html"><img src="//cdn.fcglcdn.com/brainbees/images/n/fc_logo.png" alt="Klorofil Logo" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span>{{ session('user.username') }}</span>
                                <i class="fa fa-sort-desc" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        <span>Logout</span>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        @include('sidemenu.menu')
        <!-- END LEFT SIDEBAR -->           
        <div class="main">
            <div class="main-content">
                <div class="container-fluid" id="error-success-message">
                    <div class="col-md-12 alert alert-danger @if ($errors->any()) '' @else dont-display @endif alert-dismissible" role="alert" id="error-msg-block-prod">
                        <span class="col-md-11" id="error-msg-span-prod">
                            <ul>
                             @foreach ($errors->all() as $message)
                             <li>{{ $message }}</li>
                             @endforeach
                         </ul>
                     </span>
                     <a href="#" class=" col-md-1 close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="alert alert-success @if (session('success')) '' @else dont-display @endif alert-dismissible" role="alert" id="success-msg-block-prod">
                    <span id="success-msg-span-prod">
                        <i class="fa fa-check-circle"></i>
                        @if(is_array(session('success')))
                        <ul>
                            @foreach (session('success') as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        @else
                        {{ session('success') }}
                        @endif
                    </span>
                    <a href="#" class=" col-md-1 close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
            </div>
            @yield('content')
            <!-- END MAIN CONTENT -->
        </div>
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
        @yield('footer')
            <!-- <div class="container-fluid">
                <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
            </div> -->
        </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <!-- <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="{{ asset('js/jquery.masknumber.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chartist/js/chartist.min.js')}}"></script>
    <script src="{{asset('assets/scripts/klorofil-common.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/coupon.js')}}"></script>
    <script src="{{ asset('js/formValidations.js')}}"></script>
    <script src="{{asset('assets/vendor/select2/dist/js/select2.min.js')}}" type='text/javascript'></script>

</body>

</html>
