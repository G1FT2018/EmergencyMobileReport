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
                <a class="navbar-brand " href="{URL('/')}">
                    <i class="fa fa-phone logo"></i>&nbsp;
                    Emergency Reporting System
                </a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse main-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{URL('login')}}" data-toggle="modal"><i class="fa fa-sign-in"></i>&nbsp;Login</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>  
    </nav><!-- ./nav -->

    <div class="container  pad-5" >	
        <div class="row">
            <div class="col-sm-12">  
                <div class="panel panel-default">
                    <div class="panel-body">
                       <strong>Emergency Reporting System </strong>
                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga consequuntur ullam veritatis hic est unde vel tempore sed voluptates quasi beatae magnam, aliquam cumque numquam accusamus, a dolor molestias! Nobis nemo quo ipsam earum officiis impedit, dignissimos excepturi velit eius!
                    </div>
                </div>
                
                <a href="{{URL('download-apk')}}" class="btn btn-default" target="__blank">
                    <i class="fa fa-cloud-download"></i>&nbsp;Download APK
                </a>
                      
            </div>
            <div class="col-sm-12">

            </div>
        </div>
    </div><!-- ./container -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>