<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{mix("css/app.css")}}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="card">
                            <h1 class="text-info">hola <i class="fab fa-facebook"></i></h1>
                            <i class="fas fa-angle-right"></i>sd
                            <p>Date: <input type="text" id="datepicker"></p>

                            <div class="fa-3x">
                                <i class="fas fa-spinner fa-spin"></i>
                                <i class="fas fa-circle-notch fa-spin"></i>
                                <i class="fas fa-sync fa-spin"></i>
                                <i class="fas fa-cog fa-spin"></i>
                                <i class="fas fa-spinner fa-pulse"></i>
                            </div>

                            <div class="fa-4x">
  <span class="fa-layers fa-fw" style="background:MistyRose">
    <i class="fas fa-circle" style="color:Tomato"></i>
    <i class="fa-inverse fas fa-times" data-fa-transform="shrink-6"></i>
  </span>

                                <span class="fa-layers fa-fw" style="background:MistyRose">
    <i class="fas fa-bookmark"></i>
    <i class="fa-inverse fas fa-heart" data-fa-transform="shrink-10 up-2" style="color:Tomato"></i>
  </span>

                                <span class="fa-layers fa-fw" style="background:MistyRose">
    <i class="fas fa-play" data-fa-transform="rotate--90 grow-2"></i>
    <i class="fas fa-sun fa-inverse" data-fa-transform="shrink-10 up-2"></i>
    <i class="fas fa-moon fa-inverse" data-fa-transform="shrink-11 down-4.2 left-4"></i>
    <i class="fas fa-star fa-inverse" data-fa-transform="shrink-11 down-4.2 right-4"></i>
  </span>

                                <span class="fa-layers fa-fw" style="background:MistyRose">
    <i class="fas fa-calendar"></i>
    <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-8 down-3" style="font-weight:900">27</span>
  </span>

                                <span class="fa-layers fa-fw" style="background:MistyRose">
    <i class="fas fa-certificate"></i>
    <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5 rotate--30" style="font-weight:900">NEW</span>
  </span>

                                <span class="fa-layers fa-fw" style="background:MistyRose">
    <i class="fas fa-envelope"></i>
    <span class="fa-layers-counter" style="background:Tomato">1,419</span>
  </span>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Launch demo modal
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset("js/app.js")}}"></script>
        <script src="{{asset("js/font-awesome.js")}}"></script>

    </body>
</html>
