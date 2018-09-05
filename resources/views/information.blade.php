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
                {{--@foreach($cotizaciones->cotizaciones_cliente as $cliente)--}}

                    <h5 class="font-weight-bold text-g-yellow">Hi!</h5>
                    <h1 class="font-weight-bold display-4">{{ucwords(strtolower($cliente->nombres))}}</h1>
                    <h4 class="font-weight-bold text-g-yellow">This is {{ucwords(strtolower($usuarios->name))}} i will be happy to design together a vacation </h4>
                {{--@endforeach--}}
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
            <div class="row">
                @if($confirm=='c')
                <div class="col">
                    <b class="text-22 text-success">Data sent correctly</b>
                </div>
                @endif
                <div class="col">
                    <h2 class="pt-5 display-4 font-weight-bold text-g-green">Booking Information</h2>
                    <p class="lead">Thank you for choosing Latin America For Less! Your Travel Advisor is ready to book your trip but first we need a few details. Please complete the short form below and our team will start to arrange your once-in-a-lifetime vacation. If you have any questions you can contact us at any time: <b>1-785-345-2324 or travel@gotoperu.com</b></p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="container">
            <form id="form_nuevo_pqt" name="form_nuevo_pqt" role="form" action="{{route('s_information_path')}}" method="post" enctype="multipart/form-data" >
                {{csrf_field()}}
                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <h2 class="card-header h1 font-weight-bold text-g-dark">Featured</h2>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="font-weight-bold align-middle"><i class="fas fa-id-card h3 float-left mr-2"></i> Personal Information (As it appears in your passport)</h5>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-flag"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="r_nacionality" name="r_nacionality" value="{{ucwords(strtolower($cliente->nacionalidad))}}" placeholder="Nacionality">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="r_first" name="r_first" value="{{ucwords(strtolower($cliente->nombres))}}" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="r_last" name="r_last" value="{{ucwords(strtolower($cliente->apellidos))}}" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-genderless"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="r_genero" name="r_genero" value="{{ucwords(strtolower($cliente->sexo))}}" placeholder="Gender">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-at"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="r_email" name="r_email" value="{{ucwords(strtolower($cliente->email))}}" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-phone"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="r_phone" name="r_phone" value="{{ucwords(strtolower($cliente->telefono))}}" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="date" class="form-control" id="r_birth" name="r_birth" value="{{ucwords(strtolower($cliente->fechanacimiento))}}" placeholder="Date birth">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="font-weight-bold"><i class="fas fa-address-card h3 float-left mr-2"></i> Passport Information:</h5>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-calculator"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="r_passport" name="r_passport" value="{{ucwords(strtolower($cliente->pasaporte))}}" placeholder="Passport Number">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="date" class="form-control" id="r_expiration" name="r_expiration" value="{{ucwords(strtolower($cliente->expiracion))}}" placeholder="Date Expiration">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-images"></i></div>
                                                        </div>
                                                        <input type="file" class="form-control" id="r_passport_foto" name="r_passport_foto">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    @if (Storage::disk('passport_photo')->has($cliente->pasaporte_imagen))
                                                        <img src="{{route('storage_get_imagen_path',$cliente->pasaporte_imagen)}}" class="img-fluid" alt="Passport photo" width="85" height="55">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-notes-medical"></i></div>
                                                </div>
                                                <textarea class="form-control" id="r_restriction" name="r_restriction" rows="3" placeholder="Medical or dietary restrictions">{{ucwords(strtolower($cliente->restricciones))}}</textarea>

                                                {{--<input type="date" class="form-control" id="r_expiration" name="r_expiration" value="{{ucwords(strtolower($cliente->expiracion))}}" placeholder="Date Expiration">--}}
                                            </div>
                                        </div>
                                        {{--<h5 class="font-weight-bold align-middle"><i class="fas fa-notes-medical h3 float-left mr-2"></i> Medical or dietary restrictions</h5>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<textarea class="form-control" id="r_restriction" name="r_restriction" rows="3" placeholder="Medical or dietary restrictions">{{ucwords(strtolower($cliente->restricciones))}}</textarea>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <div class="card bg-light">
                            <h2 class="card-header h1 font-weight-bold text-g-dark">Contact person in case of emergency</h2>
                            <div class="card-body">
                                {{--<div class="row">--}}
                                    {{--<div class="col">--}}
                                        {{--<h5 class="font-weight-bold align-middle"><i class="fas fa-user h3 float-left mr-2"></i> Contact</h5>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="r_full" name="r_contact"  placeholder="Full Name" value="{{ucwords(strtolower($cliente->contact))}}">
                                        </div>
                                    </div>
                                    {{--<div class="col">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<input type="text" class="form-control" id="r_full" name="r_contact"  placeholder="Full Name" value="{{ucwords(strtolower($cliente->contact))}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-calculator"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="r_contact" name="r_contact_phone"  placeholder="Phone" value="{{ucwords(strtolower($cliente->contact_telefono))}}">
                                        </div>
                                    </div>
                                    {{--<div class="col">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<input type="text" class="form-control" id="r_contact" name="r_contact_phone"  placeholder="Phone" value="{{ucwords(strtolower($cliente->contact_telefono))}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
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
                            <input type="checkbox" class="form-check-input input-lg r_confirm" id="r_confirm" style="width: 20px; height: 20px;" value="true">
                            <label class="form-check-label font-weight-bold h3 px-2 r_confirm_2" for="r_confirm" id="r_confirm_2">I have read and agree to the Terms and Conditions.</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="form-check text-center">
                            <input type="hidden" name="estado" value="{{$estado}}">
                            <input type="hidden" name="r_id" value="{{$cliente->id}}">
                            <input type="hidden" name="cotizacion_id" value="{{$idcotizacion}}">
                            <input type="hidden" name="pqt_id" value="{{$idpaquete}}">
                            <button type="submit" class="btn btn-lg btn-g-yellow btn-block text-white font-weight-bold" onclick="validar()" id="r_submit">Send</button>
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
            </form>
        </div>
    </section>

    @push('scripts')
        <script>
            function validar(){
                $('#form_nuevo_pqt').submit(function() {
//                    if($('#txt_name1').val()==''){
//                        $('#txt_name1').focus();
//                        swal(
//                            'Oops...',
//                            'Ingrese el nombre!',
//                            'error'
//                        )
//                        return false;
//                    }
                    var check=0;
                    if($('#r_confirm').prop('checked') ) {
                        check=1;
                    }
                    console.log('check:'+check);
                    if(check==0) {
                        $('#r_confirm_2').css("color", "#FF0000");
//                        swal(
//                            'Oops...',
//                            'Check terms and conditions',
//                            'warning'
//                        )
                        return false;
                    }
                });
            }
            function register(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });

                $("#submit_tip").attr("disabled", true);

                var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;


                // var s_accommodation = document.getElementsByName('accommodation[]');
                // var $accommodation = "";
                // for (var i = 0, l = s_accommodation.length; i < l; i++) {
                //     if (s_accommodation[i].checked) {
                //         $accommodation += s_accommodation[i].value+' , ';
                //     }
                // }
                // s_accommodation = $accommodation.substring(0,$accommodation.length-3);

                var s_confirm = $("#r_confirm:checked").val();
                // var s_duration = $(".duration:checked").val();
                // alert(s_confirm);

                var s_first = $('#r_first').val();
                var s_middle = $('#r_middle').val();
                var s_last = $('#r_last').val();
                var s_email = $('#r_email').val();
                var s_phone = $('#r_phone').val();

                var s_birth = $('#r_birth').val();
                var s_passport = $('#r_passport').val();
                var s_issue = $('#r_issue').val();
                var s_expiration = $('#r_expiration').val();
                var s_restriction = $('#r_restriction').val();
                var s_contact= $('#r_full').val();
                var s_contact_telefono = $('#r_contact').val();
                var s_idcliente = "{{$cliente->id}}";


                if (filter.test(s_email)){
                    sendMail = "true";
                } else{
                    $('#r_email').css("border-bottom", "2px solid #FF0000");
                    sendMail = "false";
                }
                if (s_first.length == 0 ){
                    $('#r_first').css("border-bottom", "2px solid #FF0000");
                    var sendMail = "false";
                }

                if (s_confirm != 'true' ){
                    $('#r_confirm_2').css("color", "#FF0000");
                    var sendMail = "false";
                }

                if(sendMail == "true"){
                    var datos = {
                        "txt_id" : s_idcliente,
                        "txt_first" : s_first,
                        "txt_middle" : s_middle,
                        "txt_last" : s_last,
                        "txt_email" : s_email,
                        "txt_phone" : s_phone,
                        "txt_birth" : s_birth,
                        "txt_passport" : s_passport,
                        "txt_issue" : s_issue,
                        "txt_expiration" : s_expiration,
                        "txt_restriction" : s_restriction,
                        "txt_contact" : s_contact,
                        "txt_contact_telefono" : s_contact_telefono,
                    };
                    $.ajax({
                        data:  datos,
                        url:   "{{route('s_information_path')}}",
                        type:  'post',

                        beforeSend: function () {

                            // $('#de_send').removeClass('show');
                            $("#submit_tip").addClass('d-none');
                            $("#h_load").removeClass('d-none');
                        },
                        success:  function (response) {
                            $('#h_form')[0].reset();
                            $('#submit_tip').removeClass('d-none');
                            $("#h_load").addClass('d-none');
                            $('#h_alert').removeClass('d-none');
                            // $("#h_alert b").html(response);
                            $("#h_alert").fadeIn('slow');
                            $("#submit_tip").removeAttr("disabled");
                        }
                    });
                } else{
                    $("#submit_tip").removeAttr("disabled");
                }
            }
        </script>
    @endpush

@stop