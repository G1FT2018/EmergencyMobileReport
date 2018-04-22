<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <title>Emergency Reporting System</title>
</head>
<body>
    <div class="container">
    
    <div class="row">
        
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div><!-- ./dummy col-->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="system-banner text-center">
                <span style="font-size:350%;">
                    <strong><i class="fa fa-phone" aria-hidden="true"></i></strong>
                </span>
                <h2 class="animated tada">Emergency Reporting System</HCS></h2>
            </div>      
            <div class="login-container custom-panel animated fadeIn">
                    @if(session()->has('login-error'))
                    <div class="alert alert-danger" id="status-message">
                        <strong>Error Authenticating!</strong><br>
                        {{session('login-error')}}
                    </div>
                    @endif
                    <form action="{{URL('login')}}" id="login-form" method="POST" role="form">
                        <input type="hidden" name="web_access" value="true">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="username" placeholder="username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="password" required>
                            </div>
                        </div>
                        
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="" name="remeber_me">
                                Remember Me
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
            </div><!-- ./login-container -->
            <br>
            <div class="panel panel-default pel-color animated tada">
                <div class="panel-body">
                    <button type="button" class="btn btn-default btn-block">
                        <i class="fa fa-book    "></i>&nbsp;Forgot Password
                    </button> 
                </div>
            </div>
                
        </div><!-- col-2 -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div><!-- ./dummy col-->
        
    </div>
    </div><!--./ main-container -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
