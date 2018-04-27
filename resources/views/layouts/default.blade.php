<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Agencia de Viajes en Peru | Tours Machu Picchu</title>
    <meta name="description" content="Paquetes de viaje a Perú con un auténtico operador peruano, oficinas en Lima, Cusco, Arequipa y Puno. Ofrecemos salidas diarias a Machu Picchu.">
    {{--{!! SEOMeta::generate() !!}--}}
    {{--{!! OpenGraph::generate() !!}--}}
    {{--{!! Twitter::generate() !!}--}}
    <link href="{{asset('images/icons/favicon/favicon.ico')}}" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="{{mix("css/app.css")}}">

</head>
<body data-spy="scroll" data-target="#menu" class="position-relative">


@yield('content')

@include('layouts.menu-right')


<footer class="bg-g-dark">
    <img src="{{asset('images/footer.jpg')}}" alt="footer gotoperu" class="w-100">
    <div class="container footer-logo">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <img src="{{asset('images/logos/logo-gotoperu-ave-w.png')}}" alt="logo gotoperu" class="w-100">
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-sm-8">
                <div class="alert bg-rgba-dark my-4 text-white text-center" role="alert">
                    The <strong class="text-g-yellow">ONLY Peruvian Travel Operator</strong> with direct Sales Offices in the USA
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    </div>
</footer>

<script src="{{asset("js/app.js")}}"></script>
<script src="{{asset("js/font-awesome.js")}}"></script>
{{--<script src="{{asset("js/plugins.js")}}"></script>--}}
@stack('scripts')

<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(document).ready(function () {
        $(window).on('load scroll', function () {
            var scrolled = $(this).scrollTop();
            $('#title').css({
                'transform': 'translate3d(0, ' + -(scrolled * 0.2) + 'px, 0)', // parallax (20% scroll rate)
                'opacity': 1 - scrolled / 400 // fade out at 400px from top
            });
            $('#hero-vid').css('transform', 'translate3d(0, ' + -(scrolled * 0.25) + 'px, 0)'); // parallax (25% scroll rate)
        });

        // video controls
        $('#state').on('click', function () {
            var video = $('#hero-vid').get(0);
            var icons = $('#state > span');
            $('#overlay').toggleClass('fade');
            if (video.paused) {
                video.play();
                icons.removeClass('fa-play').addClass('fa-pause');
            } else {
                video.pause();
                icons.removeClass('fa-pause').addClass('fa-play');
            }
        });
    });

    $('.popover-hover').popover({
        trigger: 'hover'
    });

    $('.popover-focus').popover({
        trigger: 'focus',
        html: true
    });


    $('#h_date').datepicker({
        dateFormat: 'mm-dd-y',
        changeMonth: true,
        changeYear: true
    });
</script>
</body>
</html>