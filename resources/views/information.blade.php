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
                                            $precio_servicio_g = $servicio->precio * $cotizaciones->nropersonas;
                                        }else{
                                            $precio_servicio_g = $servicio->precio;
                                        }
                                        $precio_servicio = $precio_servicio + $precio_servicio_g;
                                    @endphp
                                @endforeach
                            @endforeach

                            @foreach($paquetes->paquete_precios as $paquete_precio)
                                @php

                                    $utilidad_s = $paquete_precio->utilidad_s * $cotizaciones->nropersonas;
                                    $precio_hotel_s = $precio_hotel_s + ($paquete_precio->precio_s * $paquete_precio->personas_s * ($cotizaciones->duracion - 1)) + $utilidad_s;

                                    $utilidad_d = $paquete_precio->utilidad_d * $cotizaciones->nropersonas;
                                    $precio_hotel_d = $precio_hotel_d + ($paquete_precio->precio_d * $paquete_precio->personas_d * ($cotizaciones->duracion - 1)) + $utilidad_d;

                                    $utilidad_m = $paquete_precio->utilidad_m * $cotizaciones->nropersonas;
                                    $precio_hotel_m = $precio_hotel_m + ($paquete_precio->precio_m * $paquete_precio->personas_m * ($cotizaciones->duracion - 1)) + $utilidad_m;

                                    $utilidad_t = $paquete_precio->utilidad_t * $cotizaciones->nropersonas;
                                    $precio_hotel_t = $precio_hotel_t + ($paquete_precio->precio_t * $paquete_precio->personas_t * ($cotizaciones->duracion - 1)) + $utilidad_t;

                                @endphp
                            @endforeach

                        @endforeach
                    @endif
                @endforeach



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
        <div class="content-header content-header-class">
            <div class="container-fluid">
                <div class="row content-header-row content-header-row-class align-items-center">
                    <div class="col text-center">
                        <h2 class="text-white display-4">BOOKING PROCESS</h2>
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
                                        <h5 class="text-g-yellow"> ${{$precio_servicio + $precio_hotel_s}}</h5>
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
            <div class="row">
                <div class="col">
                    <h2 class="pt-5 display-4 font-weight-bold text-g-green">Booking Information</h2>
                    <p class="lead">Thank you for choosing Latin America For Less! Your Travel Advisor is ready to book your trip but first we need a few details. Please complete the short form below and our team will start to arrange your once-in-a-lifetime vacation. If you have any questions you can contact us at any time: <b>1-785-345-2324 or travel@gotoperu.com</b></p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card bg-light">
                        <h2 class="card-header h1 font-weight-bold text-g-dark">Featured</h2>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="font-weight-bold align-middle"><i class="fas fa-id-card h3 float-left mr-2"></i> Personal Information (As it appears in your passport)</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Middle Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Phone Number">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Date of Birth mm/dd/yyyy">
                                    </div>
                                </div>
                                <div class="col">
                                    <h5 class="font-weight-bold"><i class="fas fa-address-card h3 float-left mr-2"></i> Passport Information:</h5>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Passport Number">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Country of Issue">
                                    </div>
                                    <div class="form-group mb-5">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Expiration Date mm/dd/yyyy">
                                    </div>

                                    <h5 class="font-weight-bold align-middle"><i class="fas fa-notes-medical h3 float-left mr-2"></i> Medical or dietary restrictions</h5>
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Medical or dietary restrictions"></textarea>
                                    </div>

                                </div>
                            </div>

                            {{--<div class="row mt-5">--}}
                                {{--<div class="col">--}}
                                    {{--<h5 class="font-weight-bold align-middle"><i class="fas fa-notes-medical h3 float-left mr-2"></i> Medical or dietary restrictions</h5>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Medical or dietary restrictions"></textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col">--}}
                                            {{--<h5 class="font-weight-bold align-middle"><i class="fas fa-notes-medical h3 float-left mr-2"></i> Medical or dietary restrictions</h5>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col">--}}
                                            {{--<div class="row btn-group-toggle px-3" data-toggle="buttons">--}}
                                                {{--<label class="btn btn-sm py-4 col btn-primary active">--}}
                                                    {{--<input type="radio" name="options" id="option1" autocomplete="off" checked> Purchasing with Goto Peru--}}
                                                {{--</label>--}}
                                                {{--<label class="btn btn-sm py-4 col btn-primary">--}}
                                                    {{--<input type="radio" name="options" id="option2" autocomplete="off"> Purchasing Separately--}}
                                                {{--</label>--}}
                                                {{--<label class="btn btn-sm py-4 col btn-primary">--}}
                                                    {{--<input type="radio" name="options" id="option3" autocomplete="off"> Forego Insurance--}}
                                                {{--</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col">--}}
                                            {{--<small id="emailHelp" class="form-text text-muted">* If purchasing travel insurance with Peru for Less, please contact your Travel Advisor for a quote.</small>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class="card bg-light">
                        <h2 class="card-header h1 font-weight-bold text-g-dark">Contact person in case of emergency</h2>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="font-weight-bold align-middle"><i class="fas fa-user h3 float-left mr-2"></i> Contact</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Phone">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <div class="card bg-light">
                        <h2 class="card-header h1 font-weight-bold text-g-dark">Terms & Conditions</h2>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <p class="text-danger">** In order to complete your booking you must scroll to the bottom of this page and select "Agree" to the terms and conditions</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="condition-overflow card p-3">
                                        <p>By booking or participating in a tour and any related products or services (a “Tour”) with G Adventures Inc. (“G Adventures” or the “Tour Operator”), you (“you”) agree to these Terms & Conditions (the “Terms”).</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis dolorum impedit incidunt ipsum iusto molestias, nam nobis omnis sapiente ut. Ad alias autem corporis dolore obcaecati odit quasi suscipit temporibus.</p>
                                        <ul>
                                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab assumenda consectetur est facilis illum inventore modi neque officia quia sapiente? Consequatur dolorum eum fugit labore quos rem repellat suscipit tenetur!</li>
                                        </ul>
                                        <h3>1. THE BOOKING CONTRACT</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquid consequuntur dolorem doloribus fuga magnam magni nam nesciunt officia quasi! Aliquid architecto deleniti ea et incidunt laudantium qui. Nihil, sunt!</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <div class="form-check text-center">
                        <input type="checkbox" class="form-check-input input-lg" id="exampleCheck1" style="width: 20px; height: 20px;">
                        <label class="form-check-label font-weight-bold h3 px-2" for="exampleCheck1">I have read and agree to the Terms and Conditions.</label>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="form-check text-center">
                        <button type="button" class="btn btn-lg btn-g-yellow btn-block text-white font-weight-bold">Send</button>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="form-check text-center">
                        <p class="h3 text-info">We sell virtually all services available in Peru, Galapagos, Brazil, Argentina, Chile and Bolivia  </p>
                    </div>
                </div>
            </div>

        </div>
    </section>


@stop