@extends('layouts.default')

@section('content')

    <section class="header-video header-video-class d-none d-md-block">
        <div id="title" class="text-white">
            <div class="container-fluid">
                <div class="row justify-content-between mt-2">
                    <div class="col-md-6 col-lg-3">
                        <a href=""><img src="{{asset('images/logos/logo-gotoperu-ave-w.png')}}" alt="" class="img-fluid"></a>
                    </div>
                    {{--<div class="d-none d-lg-inline col-lg">--}}
                    {{--<div class="row align-items-center">--}}
                    {{--<div class="col-8">--}}
                    {{--<i class="text-g-yellow">Local expertise & global partners</i>--}}
                    {{--</div>--}}
                    {{--<div class="col-4">--}}
                    {{--<img src="{{asset('images/logos/logo-expedia2.png')}}" alt="" class="img-fluid">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <div class="col-md col-lg-3 sticky-top text-right">
                        <a href="tel:+2029963000" class="mx-3 h4">(202) 996-3000</a>
                        <a href="#" class="mx-3 h2"  data-toggle="modal" data-target="#modal-menu"><i class="fas fa-bars"></i></a>
                        <!-- Button trigger modal -->
                        {{--<div class="rounded bg-rgba-dark-1 p-4">--}}
                        {{--<div class="row">--}}
                        {{--<div class="col-4">--}}
                        {{--<img src="{{asset('images/team/doriam.jpg')}}" alt="" class="rounded-circle img-fluid">--}}
                        {{--</div>--}}
                        {{--<div class="col">--}}
                        {{--<h4 class="font-weight-bold m-0">Doriam Perez</h4>--}}
                        {{--<h6 class="">doriam@gotoperu.com</h6>--}}
                        {{--<h4 class="font-weight-bold">(51)980476535</h4>--}}
                        {{--<a href="" class="btn btn-outline-light">More about me</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="overlay" class="position-relative overlay-class">
            <div id="overlay" class="overlay-img overlay-class">
                {{--<video class="" id="hero-vid" poster="{{asset('images/slider/package-1.jpg')}}" autoplay loop muted>--}}
                {{--<source src="{{asset('media/video6.mp4')}}" />--}}
                {{--<source src="{{asset('media/video6.m4v')}}" type="video/mp4" />--}}
                {{--<source src="{{asset('media/video6.webm')}}" type="video/webm" />--}}
                {{--<source  src="{{asset('media/video6.ogv')}}" type="video/ogg" />--}}
                {{--</video>--}}

                <img src="{{asset('images/cusco.jpg')}}" alt="" id="hero-vid">
                @php
                    $precio_servicio = 0;

                    $precio_servicio1 = 0;
                    $precio_hotel_s = 0;
                    $precio_hotel_d = 0;
                    $precio_hotel_m = 0;
                    $precio_hotel_t = 0;
                @endphp
                @foreach($cotizacion as $cotizaciones)
                    @if(isset($cotizaciones))
                        @foreach($cotizaciones->paquete_cotizaciones as $paquetes)
                            @foreach($paquetes->itinerario_cotizaciones as $itinerario)

                                @foreach($itinerario->itinerario_servicios as $servicio)
                                    @php
                                        if ($servicio->precio_grupo == 0){
                                            $precio_servicio_g = $servicio->precio;
                                        }elseif($servicio->precio_grupo == 1){
                                            $precio_servicio_g = $servicio->precio/$cotizaciones->nropersonas;
                                        }

                                        $precio_servicio = $precio_servicio +$precio_servicio_g;
                                        $precio_servicio1 .=$precio_servicio_g.'+';

                                    @endphp
                                @endforeach
                            @endforeach

                            @foreach($paquetes->paquete_precios as $paquete_precio)
                                @php

                                    $utilidad_s = $paquete_precio->utilidad_s;
                                    $precio_hotel_s = $precio_hotel_s + ($paquete_precio->precio_s * ($cotizaciones->duracion - 1)) + $utilidad_s;

                                    $utilidad_d = $paquete_precio->utilidad_d;
                                    $precio_hotel_d = $precio_hotel_d + (($paquete_precio->precio_d / 2) * ($cotizaciones->duracion - 1)) + $utilidad_d;

                                    $utilidad_m = $paquete_precio->utilidad_m;
                                    $precio_hotel_m = $precio_hotel_m + (($paquete_precio->precio_m / 2) * ($cotizaciones->duracion - 1)) + $utilidad_m;

                                    $utilidad_t = $paquete_precio->utilidad_t;
                                    $precio_hotel_t = $precio_hotel_t + (($paquete_precio->precio_t / 3) * ($cotizaciones->duracion - 1)) + $utilidad_t;

                                @endphp
                            @endforeach

                        @endforeach
                    @endif
                @endforeach

                {{--                {{ $precio_servicio}} - {{$precio_hotel_d}} / {{$precio_servicio + $precio_hotel_d}}--}}

                @php
                    $precio_total_s =  $precio_servicio + $precio_hotel_s;
                    $precio_total_d =  $precio_servicio + $precio_hotel_d;
                    $precio_total_m =  $precio_servicio + $precio_hotel_m;
                    $precio_total_t =  $precio_servicio + $precio_hotel_t;

                    if ($paquete_precio->personas_s == 0){
                        $hide_s = 'd-none';
                    }else{
                        $hide_s = '';
                    }
                    if ($paquete_precio->personas_d == 0){
                        $hide_d = 'd-none';
                    }else{
                        $hide_d = '';
                    }
                    if ($paquete_precio->personas_m == 0){
                        $hide_m = 'd-none';
                    }else{
                        $hide_m = '';
                    }
                    if ($paquete_precio->personas_t == 0){
                        $hide_t = 'd-none';
                    }else{
                        $hide_t = '';
                    }
                @endphp



                <div class="header-expedia-card col-md-5 col-lg-5 col-xl-3 text-white rounded bg-rgba-dark p-3 d-none">
                    <div class="row">
                        @foreach($usuario->where('id', $cotizaciones->users_id) as $usuarios)
                            <div class="col">
                                <h4 class="font-weight-bold m-0">{{$usuarios->name}}</h4>
                                <h6 class="">{{$usuarios->email}}</h6>
                                <h4 class="font-weight-bold">(51)980476535</h4>
                                <button  type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModal">More about me</button>
                            </div>

                            <div class="col">
                                <img src="{{asset('images/team/doriam.jpg')}}" alt="" class="rounded img-fluid">
                            </div>
                        @endforeach

                    </div>
                </div>


            </div>

            <div class="header-expedia p-3 w-100 d-none d-lg-inline text-white">
                {{--<p class="text-white h6"><span class="bg-g-green p-1 rounded-circle px-3 text-white">1</span> Share your travel plans <span class="bg-g-yellow p-1 rounded-circle px-3 text-white ml-5">2</span> Receive a customize itinerary and quote <span class="bg-g-dark p-1 rounded-circle px-3 text-white ml-5">3</span> Discover the best of Peru with GOTOPERU</p>--}}
                @foreach($cotizaciones->cotizaciones_cliente as $cliente)

                    <h5 class="font-weight-bold text-g-yellow">Hi!</h5>
                    <h1 class="font-weight-bold display-4">{{ucwords(strtolower($cliente->cliente->nombres))}}</h1>
                    <h4 class="font-weight-bold text-g-yellow">This is {{ucwords(strtolower($usuarios->name))}} i will be happy to design together a vacation </h4>
                @endforeach
                {{--<h4 class="font-weight-bold">I'm your personal Travel Advisor</h4>--}}
            </div>
        </div>
        <div class="content-header content-header-class">
            <div class="container-fluid">
                <div class="row content-header-row content-header-row-class align-items-center">
                    <div class="col text-center">
                        {{--<h2 class="text-white display-4">BOOKING PROCESS</h2>--}}
                        {{--                        <span class="text-white h3 d-block">{{$paquetes->duracion}} days | ${{$precio_servicio + $precio_hotel_s}}</span>--}}
                        <a href="" class="text-white"><i class="fa fa-angle-down fa-4x"></i></a>

                        {{--<div class="text-center os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0s">--}}
                        {{--<div class="">--}}
                        {{--<div class="content-video-1">--}}
                        {{--<img src="images/travel/video-1.jpg" alt="video">--}}

                        {{--<div class="content-video-btn-1">--}}
                        {{--<a href="https://www.youtube.com/watch?v=pNe-NtXIULs"  class="html5lightbox text-white" title=""><i class="fa fa-play-circle fa-4x"></i></a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}

                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="bg-white pt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <h3 class="font-weight-bold">Tour/Plan:</h3>
                                        </div>
                                        <div class="col">
                                            <h5 class="text-g-yellow"> {{($paquetes->codigo)}}</h5>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <h3 class="font-weight-bold">Travel Dates:</h3>
                                        </div>
                                        <div class="col">

                                            <h5>
                                                {{date("d F, Y", strtotime($cotizaciones->fecha))}} -
                                                @php
                                                    $duracion = $paquetes->duracion - 1;
                                                    $fecha = date($cotizaciones->fecha);
                                                    $nueva_fin = strtotime('+'.$duracion.' day' , strtotime($fecha)) ;
                                                    $nueva_fin = date ( 'Y-m-j' , $nueva_fin );
                                                @endphp
                                                {{date("d F, Y", strtotime($nueva_fin))}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <h3 class="font-weight-bold">Price USD:</h3>
                                        </div>
                                        <div class="col">
                                            <h5 class="text-g-yellow">
                                                <span class="{{$hide_s}}">${{ceil($precio_total_s)}}</span>
                                                <span class="{{$hide_d}}">${{ceil($precio_total_d)}}</span>
                                                <span class="{{$hide_m}}">${{ceil($precio_total_m)}}</span>
                                                <span class="{{$hide_t}}">${{ceil($precio_total_t)}}</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="row py-3 align-items-center">
                                        <div class="col">
                                            <h3 class="font-weight-bold">Destinations:</h3>
                                        </div>
                                        <div class="col">
                                            {{--@foreach($paquete_destinos->where('idpaquetes',$paquetes->id) as $paquete_destino)--}}
                                            {{--<p class="font-wefont-weight-bold"><i class="fa fa-check"></i> {{ucwords(strtolower($paquete_destino->destinos->nombre))}}</p>--}}
                                            {{--<a href="{{route('destinations_country_show_path', ['peru-travel', str_replace(' ', '-', strtolower($paquete_destino->destinos->nombre))])}}-tours"><img src="{{asset('images/destinations/destinations/'.str_replace(' ','-', strtolower($paquete_destino->destinos->nombre)).'')}}.jpg" alt="" width="50" height="50" class="rounded-circle" data-toggle="tooltip" data-placement="top" title="{{ucwords(strtolower($paquete_destino->destinos->nombre))}}"></a>--}}
                                            {{--@endforeach--}}

                                            @foreach($destinos as $destino)
                                                <a href=""><img src="{{asset('images/destinations/destinations/'.str_replace(' ','-', strtolower($destino)).'')}}.jpg" alt="" width="50" height="50" class="rounded-circle" data-toggle="tooltip" data-placement="top" title="{{ucwords(strtolower($destino))}}"></a>
                                            @endforeach

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-white">
        <div class="container">

            <div class="row py-4">
                <div class="col">
                    <h2 class="pt-2 display-4 font-weight-bold text-g-green">Book your Trip with Latin America for Less</h2>
                    {{--<p class="lead">Thank you for choosing Latin America For Less! Your Travel Advisor is ready to book your trip but first we need a few details. Please complete the short form below and our team will start to arrange your once-in-a-lifetime vacation. If you have any questions you can contact us at any time: <b>1-785-345-2324 or travel@gotoperu.com</b></p>--}}
                    <p class="font-weight-bold">Welcome to the GotoPeru certified secure credit card payment site. Your travel advisor has directed you to this web page to book your trip to any of our destinations. Please fill in the amount you wish to pay via credit card, select your travel advisor, and click Book Your Trip! You will then be prompted to enter your credit card information. Your credit card information and personal details entered via this page are handled securely. After the payment is complete, you will receive an email confirmation. Thank you for choosing GotoPeru.</p>

                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-header text-g-yellow font-weight-bold"><i class="fa fa-lock"></i> Pago seguro</div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="f_name" class="font-weight-bold h5 text-secondary">Full Name</label>
                                                <input type="text" class="form-control" id="f_name" placeholder="Full Name">
                                                <small id="emailHelp" class="form-text text-muted">As it appears on your credit card.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="f_card" class="font-weight-bold h5 text-secondary">Credit Card Number</label>
                                                <input type="text" class="form-control" id="f_card" placeholder="Credit Card Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="f_card" class="font-weight-bold h5 text-secondary">Mont</label>
                                                <input type="text" class="form-control" id="f_card" placeholder="Mont" value="2899.00">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="f_card" class="font-weight-bold h5 text-secondary">Year</label>
                                                <input type="text" class="form-control" id="f_card" placeholder="Year">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="f_card" class="font-weight-bold h5 text-secondary">CVV</label>
                                                <input type="text" class="form-control" id="f_card" placeholder="Mont">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <a href=""><i class="fa fa-question-circle"></i></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">I accept the above terms and conditions</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col">
                                            <button class="btn btn-lg btn-success">Pagar Ahora</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center py-4">
                <div class="col-4">
                    <img src="https://www.peruforless.com/content-files/uploads/s-secured-credit-card-payment.png" alt="" class="w-100">
                </div>
            </div>


        </div>
    </section>



@stop