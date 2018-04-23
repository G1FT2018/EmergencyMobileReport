<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/toastr/toastr.min.css')}}">
    <title>Emergency Reporting System</title>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-custom rad-0" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand " href="{{URL('dashboard')}}">
                    <i class="fa fa-phone logo"></i>&nbsp;
                            Emergency Reporting System
                </a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse main-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-clone" aria-hidden="true"></i>&nbsp;
                                <b class="caret"></b>
                            </a>
                    <ul class="dropdown-menu">
                            <li>
                                <a href="{{URL('users')}}">
                                    <i class="fa fa-user" aria-hidden="true"></i>&nbsp;Users</a>
                            </li>
                            <li>
                                <a href="{{URL('messages')}}">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Messages</a>
                            </li>
                            <li>
                                <a href="{{URL('reports')}}">
                                    <i class="fa fa-archive" aria-hidden="true"></i>&nbsp;Reports</a>
                            </li>
                            <li>
                                    <a href="{{URL('emergency-unit')}}">
                                        <i class="fa fa-bell" aria-hidden="true"></i>&nbsp;Emergency Unit</a>
                                </li>
                            <li class="divider"></li>
                            <li>
                                <a href="dashboard">
                                    <i class="glyphicon glyphicon-dashboard" aria-hidden="true"></i>&nbsp;Dashboard</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#settings-win" data-toggle="modal"><i class="fa fa-cogs"></i>&nbsp;Settings</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa fa-user" aria-hidden="true"></i>&nbsp;<span id="user">{{ucfirst(session('username'))}}</span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>  
    </nav><!-- ./nav -->


    @yield('content')
    @include('partials.settings-win')
    <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/toastr/toastr.min.js')}}"></script>
    @yield('scripts');
    </body>
</html>