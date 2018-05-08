@extends('layouts.default')

@section('content')

    <section class="header-video d-none d-md-block">
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
                    <div class="col-md col-lg-3 sticky-top">
                        {{--<a href="tel:+2029963000" class="mx-3 h4">(202) 996-3000</a>--}}
                        {{--<a href="#" class="mx-3 h2"  data-toggle="modal" data-target="#modal-menu"><i class="fas fa-bars"></i></a>--}}
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
        <div id="overlay" class="position-relative">
            <div id="overlay" class="overlay-img">
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



                <div class="header-expedia-card col-md-5 col-lg-5 col-xl-3 text-white rounded bg-rgba-dark p-3">
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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row content-header-row align-items-center">
                    <div class="col text-center">
                        <h2 class="text-white display-4">PLAN {{$paquetes->plan}}</h2>
                        <p class="text-white h3 d-block">{{$paquetes->duracion}} days |
                            <span class="{{$hide_s}}">${{ceil($precio_total_s)}}</span>
                            <span class="{{$hide_d}}">${{ceil($precio_total_d)}}</span>
                            <span class="{{$hide_m}}">${{ceil($precio_total_m)}}</span>
                            <span class="{{$hide_t}}">${{ceil($precio_total_t)}}</span>

                        </p>
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

    <ul id="menu" class="nav nav-pills nav-fill bg-light rounded  d-sm-flex sticky-top nav-itinerary">
        <li class="nav-item d-none d-sm-block">
            <a class="nav-link text-white rounded-0 bg-g-dark" href="#overview">Overview</a>
        </li>
        <li class="nav-item d-none d-sm-block">
            <a class="nav-link text-white rounded-0 bg-g-green" href="#Itinerary">Itinerary</a>
        </li>
        <li class="nav-item d-sm-none">
            <a class="nav-link text-white rounded-0 bg-g-green" href="#Itinerary-2">Itinerary</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white rounded-0 bg-danger" href="#Hotels">Hotels</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white rounded-0 bg-info" href="#Prices">Prices</a>
        </li>
        <li class="nav-item d-none d-sm-block">
            <a class="nav-link text-white rounded-0 bg-g-yellow" href="#why">Why Us</a>
        </li>
    </ul>
    {{--<section class="clearfix">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col">--}}
                    {{--<a href="" class="rounded-circle bg-g-dark p-4 h2 text-white font-weight-bold">PLAN A</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    <section class="bg-white">
        <div class="container-fluid">
            <div class="row justify-content-center pt-4">
                @foreach($paquete_p->sortBy('plan') as $paquetes_p)
                    @if($paquetes_p->id == $paquetes->id)
                    <div class="col-auto">
                        <a href="{{route('home_path', [$paquetes_p->cotizaciones_id, $paquetes_p->id])}}" class="bg-g-dark text-white py-3 px-4 rounded-circle h2 font-weight-bold d-block">PLAN {{$paquetes_p->plan}}
                            {{--<small class="d-block h5 text-center text-g-yellow">${{ceil($precio_servicio + $precio_hotel_s)}}</small>--}}
                        </a>
                    </div>
                    @else
                    <div class="col-auto">
                        <a href="{{route('home_path', [$paquetes_p->cotizaciones_id, $paquetes_p->id])}}" class="bg-light text-secondary py-3 px-4 rounded-circle h2 font-weight-bold d-block">PLAN {{$paquetes_p->plan}}
                            {{--<small class="d-block h5 text-center">${{ceil($precio_servicio + $precio_hotel_s)}}</small>--}}
                        </a>
                    </div>
                    @endif
                @endforeach
                <div class="col-12 text-center">
                    <p class="d-block text-primary">Usted tiene 2 planes para un viaje inolvidable</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div id="overview">
                        <div class="row">
                            <div class="col-8">
                                <h2 class="mb-4 display-4 font-weight-bold text-g-dark">Overview</h2>
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h3 class="font-weight-bold text-right">Trip</h3>
                                    </div>
                                    <div class="col">
                                        <h5 class="text-g-yellow"> {{($paquetes->titulo)}}</h5>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h3 class="font-weight-bold text-right">Arrival </h3>
                                    </div>
                                    <div class="col">

                                        <h5>{{date("d F, Y", strtotime($cotizaciones->fecha))}}</h5>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h3 class="font-weight-bold text-right">Departure</h3>
                                    </div>
                                    <div class="col">
                                        @php
                                            $duracion = $paquetes->duracion - 1;
                                            $fecha = date($cotizaciones->fecha);
                                            $nueva_fin = strtotime('+'.$duracion.' day' , strtotime($fecha)) ;
                                            $nueva_fin = date ( 'Y-m-j' , $nueva_fin );
                                        @endphp
                                        <h5>{{date("d F, Y", strtotime($nueva_fin))}}</h5>
                                    </div>
                                </div>
                                <div class="row py-3 align-items-center">
                                    <div class="col-2">
                                        <h3 class="font-weight-bold text-right">Highlights</h3>
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
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h3 class="font-weight-bold text-right">Outline</h3>
                                    </div>
                                    <div class="col">
                                        <div class="box-route-ininerary p-2 rounded bg-light">
                                            @foreach($paquetes->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                                                <p>
                                                    <strong>Day {{$itinerario->dias}}: </strong> {{ucwords(strtolower($itinerario->titulo))}}
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                {{--<div class="rounded bg-rgba-dark-1 p-4 sticky-top sticky-top-50">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-4">--}}
                                            {{--<img src="{{asset('images/team/doriam.jpg')}}" alt="" class="rounded-circle img-fluid">--}}
                                        {{--</div>--}}
                                        {{--<div class="col">--}}
                                            {{--<h4 class="font-weight-bold m-0">Doriam Perez</h4>--}}
                                            {{--<h6 class="">doriam@gotoperu.com</h6>--}}
                                            {{--<h4 class="font-weight-bold">(51)980476535</h4>--}}
                                            {{--<a href="" class="btn btn-outline-g-dark">More about me</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="row sticky-top sticky-top-50">
                                    <div class="col">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <div class="d-block text-left">
                                                    <span class="text-g-yellow h4 font-weight-bold align-bottom">{{$paquetes->duracion}} Days</span>
                                                    {{--<img src="{{asset('images/icons/subtitle.png')}}" alt="" class="img-fluid mb-1" width="100">--}}
                                                </div>
                                                {{--<p class="text-primary h4 font-weight-bold">10 Day</p>--}}
                                                <p class="py-2 m-0 text-center">
{{--                                                    <span class="text-info font-weight-bold display-4">${{ceil($precio_servicio + $precio_hotel_s)}}</span>--}}
                                                    <span class="{{$hide_s}} text-info font-weight-bold display-4">${{ceil($precio_total_s)}}</span>
                                                    <span class="{{$hide_d}} text-info font-weight-bold display-4">${{ceil($precio_total_d)}}</span>
                                                    <span class="{{$hide_m}} text-info font-weight-bold display-4">${{ceil($precio_total_m)}}</span>
                                                    <span class="{{$hide_t}} text-info font-weight-bold display-4">${{ceil($precio_total_t)}}</span>
                                                    <small>USD</small></p>
                                                <p class="text-secondary h5 font-weight-bold"><strong>Proposals:</strong>
                                                @foreach($paquete_p->sortBy('plan') as $paquetes_p)
                                                    @if($paquetes_p->id == $paquetes->id)
                                                        <a href="{{route('home_path', [$paquetes_p->cotizaciones_id, $paquetes_p->id])}}">Plan {{$paquetes_p->plan}}</a> |
                                                    @else
                                                        <a href="{{route('home_path', [$paquetes_p->cotizaciones_id, $paquetes_p->id])}}" class="text-secondary">Plan {{$paquetes_p->plan}}</a> |
                                                    @endif
                                                @endforeach

                                                </p>
                                                <p class="text-secondary h5 font-weight-bold m-0"><strong>Code:</strong> {{$paquetes->codigo}}</p>
                                                {{--<a href="#book-now" class="btn btn-warning btn-block btn-lg btn-info mt-3">Consulte</a>--}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div id="Itinerary">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-8">
                                        <h2 class="pt-5 mb-4 display-4 font-weight-bold text-g-green">Itinerary</h2>
                                        <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link resumen active" id="home-tab" data-toggle="tab" href="#resumen" role="tab" aria-controls="resumen" aria-selected="true">Resumen</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link resumen" id="profile-tab" data-toggle="tab" href="#detalle" role="tab" aria-controls="detalle" aria-selected="false">Detallado</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="resumen" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-8">
                                                @foreach($paquetes->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                                                    @php
                                                        $duracion = $itinerario->dias - 1;
                                                        $fecha = date($cotizaciones->fecha);
                                                        $nueva_fin = strtotime('+'.$duracion.' day' , strtotime($fecha)) ;
                                                        $nueva_fin = date ( 'Y-m-j' , $nueva_fin );
                                                    @endphp
                                                    <div id="day-{{$itinerario->dias}}" class="text-justify">
                                                        {{--<h3 class="text-g-yellow pt-5">{{$itinerario->titulo}}</h3>--}}
                                                        <h4 class="font-weight-bold pt-5 text-g-yellow align-items-center"><span class="badge badge-pill badge-g-dark">{{date("F d", strtotime($nueva_fin))}}: </span> <span>{{ucwords(strtolower($itinerario->titulo))}}</span></h4>
                                                        @php echo $itinerario->descripcion; @endphp
                                                    </div>

                                                @endforeach
                                            </div>
                                            <div class="col d-none d-sm-block">
                                                <div class="sticky-top sticky-top-50">
                                                    <nav id="menu" class="navbar navbar-light nav-goto-side w-100">
                                                        <nav class="nav nav-pills flex-column w-100">
                                                            @foreach($paquetes->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                                                                <a class="nav-link" href="#day-{{$itinerario->dias}}"><strong>Day {{$itinerario->dias}}: </strong> {{ucwords(strtolower($itinerario->titulo))}}</a>
                                                            @endforeach

                                                            {{--<a class="nav-link" href="#machu-picchu">Machu Picchu</a>--}}
                                                            {{--<a class="nav-link" href="#sacred-valley">Sacred Valley</a>--}}
                                                            {{--<a class="nav-link" href="#lake-titicaca">Lake Titicaca</a>--}}
                                                            {{--<a class="nav-link" href="#lima">Lima</a>--}}
                                                            {{--<a class="nav-link" href="#treks">Treks</a>--}}

                                                        </nav>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="detalle" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-8">
                                                @php
                                                    $i = 1;
                                                    $num_des = count($paquetes->itinerario_cotizaciones);
                                                @endphp
                                                @foreach($paquetes->itinerario_cotizaciones->sortBy('dia') as $itinerario)
                                                    @php
                                                        $duracion = $itinerario->dias - 1;
                                                        $fecha = date($cotizaciones->fecha);
                                                        $nueva_fin = strtotime('+'.$duracion.' day' , strtotime($fecha)) ;
                                                        $nueva_fin = date ( 'Y-m-j' , $nueva_fin );
                                                    @endphp

                                                    <div class="timeline @php if($i == $num_des) echo 'timeline-f' @endphp">
                                                        <div class="timeline-title">
                                                            <span class="rounded-circle bg-g-green text-white py-4 font-weight-bold">{{date("F d", strtotime($nueva_fin))}}</span>
                                                        </div>
                                                        {{--<div class="col bg-dark">--}}
                                                        {{--sdsdskl--}}
                                                        {{--</div>--}}
                                                        <div class="col">
                                                            {{--<div class="col">--}}
                                                            {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dolorum error esse eveniet, inventore maxime, modi nam nisi nulla saepe vitae voluptatem voluptatum! Corporis deserunt eos fugiat numquam quidem voluptas?--}}
                                                            {{--</div>--}}
                                                            <div class="timeline-content position-relative">
                                                                <div class="row">
                                                                    <div class="timeline-point">
                                                                        <i class="fa fa-circle text-secondary"></i>
                                                                    </div>
                                                                    <div class="timeline-custom-col content-col ">
                                                                        <div class="timeline-location-block">
                                                                            <p class="location-name">{{ucwords(strtolower($itinerario->titulo))}} <i class="fa fa-map-marker-alt icon-marker"></i></p>
                                                                            <div class="description">
                                                                                @php echo $itinerario->descripcion @endphp
                                                                            </div>
                                                                        </div>
                                                                        {{--<div class="timeline-custom-col">--}}
                                                                        {{--<div class="timeline-image-block">--}}
                                                                        {{--<img src="http://wp.swlabs.co/exploore/wp-content/uploads/2016/05/london.png" alt="">--}}
                                                                        {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php $i++; @endphp
                                                @endforeach
                                            </div>
                                            <div class="col sticky-top-50">
                                                <div class="sticky-top my-4 sticky-top-50">
                                                    <img src="{{asset('images/maps/'.$paquetes->codigo.'.jpg')}}" alt="" class="img-fluid rounded">
                                                    {{--<button class="btn btn-block btn-lg btn-g-yellow mt-2">Book Now</button>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div>
                        <div class="row mt-5">
                            <div class="col-8">
                                <div class="row" id="Hotels">
                                    <div class="col">
                                        <h2 class="pt-5 mb-4 display-4 font-weight-bold text-danger">HOTELS</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        {{--<h3 class="text-secondary h4"><strong>Hotels</strong></h3>--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores at distinctio eos error minus, perspiciatis praesentium sint suscipit ullam voluptatum. Ab, aliquid architecto atque consequuntur expedita hic inventore non repudiandae!</p>--}}
                                        <div class="alert alert-primary text-center mt-3" role="alert">|
                                            @foreach($destinos as $destino1)
                                                <a href="#{{strtolower($destino1)}}-hotel" class="font-weight-bold">{{strtoupper($destino1)}} </a> |
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        @foreach($destinos as $destino2)
                                            <h5 class="text-g-yellow pt-4" id="{{strtolower($destino2)}}-hotel"><i class="fa fa-check"></i> {{$destino2}} HOTEL</h5>
                                            <div class="row">

                                                @foreach($hotel->where('localizacion', $destino2) as $hoteles)

                                                    <div class="col-6 d-flex my-3">
                                                        <div class="row">
                                                            <div class="col-auto d-none d-sm-block">
                                                                <img src="" alt="" class=" rounded-circle" width="50" height="50">
                                                            </div>
                                                            <div class="col">
                                                                <a href="" class="h5 align-middle">{{$hoteles->razon_social}}</a>

                                                                @for($i=0; $i < $hoteles->categoria; $i++)
                                                                    {{--{{$i}}-122133--}}
                                                                    <small><i class="fa fa-star text-g-yellow"></i></small>
                                                                @endfor

                                                                <small class="d-block text-secondary"><i class="fa fa-map-marker-alt"></i> {{$hoteles->direccion}}</small>

                                                                <p class="pt-2"><b>Services:</b>

                                                                    <i class="fa fa-check text-secondary"></i>

                                                                </p>
                                                                {{--                                                        <a href="{{$hoteles_destino->hotel->url}}" class="btn btn-outline-secondary" target="_blank">{{$hoteles_destino->hotel->nombre}}</a>--}}
                                                            </div>
                                                        </div>
                                                        {{--<hr>--}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="row" id="Prices">
                                    <div class="col">
                                        <h2 class="pt-5 mb-4 display-4 font-weight-bold text-info">Prices</h2>
                                        <h5>Prices Per Person <small class="text-primary font-weight-bold">($USD)</small></h5>
                                        <div class="card border-secondary">
                                            <p class="card-header bg-dark text-g-yellow">{{$paquete_precio->estrellas}} star hotel category </p>
                                            <div class="card-body p-0">
                                                <table class="table m-0">
                                                    <thead class="title-header bg-light">
                                                    <tr>
                                                        <th class="{{$hide_s}}">Simple</th>
                                                        <th class="{{$hide_d}}">Doble</th>
                                                        <th class="{{$hide_m}}">Matrimonial</th>
                                                        <th class="{{$hide_t}}">Triple</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="{{$hide_s}}">
                                                            <sup>$</sup> {{ceil($precio_total_s)}}
                                                        </td>
                                                        <td class="{{$hide_d}}">
                                                            <sup>$</sup> {{ceil($precio_total_d)}}
                                                        </td>
                                                        <td class="{{$hide_m}}">
                                                            <sup>$</sup> {{ceil($precio_total_m)}}
                                                        </td>
                                                        <td class="{{$hide_t}}">
                                                            <sup>$</sup> {{ceil($precio_total_t)}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col">
                                                <h3 class="text-secondary h4"><strong>Included</strong></h3>
                                                @php echo $paquetes->incluye; @endphp
                                            </div>
                                            <div class="col">
                                                <h3 class="text-secondary h4"><strong>Not Included</strong></h3>
                                                @php echo $paquetes->noincluye; @endphp
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="why">
                                    <div class="col">
                                        <h3 class="pt-5 mb-4 display-4 font-weight-bold text-g-yellow">Why Us</h3>

                                        <h3 class="font-weight-bold">2000+ Testimonials</h3>
                                        <p>With 16+ years in the travel business, we have a long history of delivering superlative service. Click here to see what our travelers say about us.</p>

                                        <h3 class="font-weight-bold">Prompt and Personalized Service</h3>
                                        <p>All tours are fully customizable. We work alongside you to create the perfect itinerary. Private or group. Luxury or budget. We do it all! All airport transfers in Peru are private.</p>

                                        <h3 class="font-weight-bold">Superb Staff</h3>
                                        <p>We have over 50 team members who work full time in order to deliver trips of a lifetime, to all our destinations. Most of our team is based in South America and directly supervise all of your travel arrangements. Meet our team.</p>

                                        <h3 class="font-weight-bold">Expert Local Guides</h3>
                                        <p>We work with English-speaking, local certified tour guides who are passionate about Peru. They will help you get to the heart of each destination you visit.</p>

                                        <h3 class="font-weight-bold">24/7 In-trip Assistance</h3>
                                        <p>Once your trip begins, you have access to our 24-hour emergency phone number. Our English-speaking operators will be there to assist you with any query or concern.</p>

                                        <h3 class="font-weight-bold">Free Portable Wi-Fi</h3>
                                        <p>We want you to stay connected with family and friends. If you book one of our Peru Specials (minimum stay of 4 days) with a stop in Cusco, Machu Picchu, and the Sacred Valley, we will provide you with free portable Wi-Fi. You’ll have access to portable, fast, and reliable internet during the Cusco and Machu Picchu portion of your trip, to help you stay connected. This offer is available when you pay by check, direct deposit, or wire transfer. Moreover, you will have access to 24/7 English-speaking traveler assistance during your travels.</p>

                                        <h3 class="font-weight-bold">Best Value</h3>
                                        <p>Our clients have written our history through their testimonials and online posts. We continuously carry out extensive research on all types of services to build the strongest brand name in travel to Peru.</p>



                                        <div class="jumbotron">
                                            <div class="container">
                                                <h1 class="font-weight-bold">Ready to Plan?</h1>
                                                <p>We require 30% of the land package and full payment for flights or special services in order to reserve your trip. The remaining amount is due no later than 45 days before arrival.</p>
                                                <p>(51)980476535</p>
                                                <p><a class="btn-link" href="#" role="button">doriam@gotoperu.com</a></p>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="col">
                                <div class="row sticky-top sticky-top-50">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card bg-light">
                                                    <div class="card-body">
                                                        <div class="d-block text-left">
                                                            <span class="text-g-yellow h4 font-weight-bold align-bottom">{{$paquetes->duracion}} Days</span>
                                                            {{--<img src="{{asset('images/icons/subtitle.png')}}" alt="" class="img-fluid mb-1" width="100">--}}
                                                        </div>
                                                        {{--<p class="text-primary h4 font-weight-bold">10 Day</p>--}}
                                                        <p class="py-2 m-0 text-center">
                                                            <span class="text-info font-weight-bold display-4">${{ceil($precio_servicio + $precio_hotel_s)}}</span>
                                                            <small>USD</small></p>
                                                        <p class="text-secondary h5 font-weight-bold"><strong>Proposals:</strong>
                                                            @foreach($paquete_p->sortBy('plan') as $paquetes_p)
                                                                @if($paquetes_p->id == $paquetes->id)
                                                                    <a href="{{route('home_path', [$paquetes_p->cotizaciones_id, $paquetes_p->id])}}">Plan {{$paquetes_p->plan}}</a> |
                                                                @else
                                                                    <a href="{{route('home_path', [$paquetes_p->cotizaciones_id, $paquetes_p->id])}}" class="text-secondary">Plan {{$paquetes_p->plan}}</a> |
                                                                @endif
                                                            @endforeach

                                                        </p>
                                                        <p class="text-secondary h5 font-weight-bold m-0"><strong>Code:</strong> {{$paquetes->codigo}}</p>
                                                        {{--<a href="#book-now" class="btn btn-warning btn-block btn-lg btn-info mt-3">Consulte</a>--}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="rounded bg-rgba-dark-1 p-4 mt-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <img src="{{asset('images/team/doriam.jpg')}}" alt="" class="rounded-circle img-fluid">
                                                </div>
                                                <div class="col">
                                                    <h4 class="font-weight-bold m-0">Doriam Perez</h4>
                                                    <h6 class="">doriam@gotoperu.com</h6>
                                                    <h4 class="font-weight-bold">(51)980476535</h4>
                                                    <button type="button" class="btn btn-outline-g-dark" data-toggle="modal" data-target="#exampleModal">More about me</button>
                                                </div>
                                            </div>
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


@stop