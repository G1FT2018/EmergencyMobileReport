<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EMRA</title>

        <!-- Fonts -->
      <!--   <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->

        <!-- Styles -->
            <link rel="stylesheet" href="<?php echo asset('css/main.css'); ?>" type="text/css">
    </head>

    <body>
<!--
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
                    }
                                  .full-height {
                                      height: 100vh;
                                  }

   .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
                        .links > a {
                              color: #636b6f;
                              padding: 0 25px;
                              font-size: 30px;
                              font-weight: 600;
                              letter-spacing: .1rem;
                              text-decoration: none;
                              text-transform: uppercase;
                          }
  -->

  <!--      <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

    -->

            <div class="content">
                <div class="title m-b-md">
                    Emergency Mobile Reporting application
                </div>
            </div>

                      @yield('content')
                      @yield('footer')

    </body>
</html>
