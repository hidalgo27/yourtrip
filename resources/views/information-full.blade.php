@extends('layouts.default')

@section('content')

    <section class="header-video header-video-class d-none d-md-block">
        <div id="title" class="text-white">
            <div class="container-fluid">
                <div class="row justify-content-between mt-2">
                    <div class="col-md-6 col-lg-3">
                        <a href=""><img src="{{asset('images/logos/logo-gotoperu-ave-w.png')}}" alt="" class="img-fluid"></a>
                    </div>
                   <div class="col-md col-lg-3 sticky-top text-right">
                    <a href="tel:+2029963000" class="mx-3 h4">(202) 996-3000</a>
                    <a href="#" class="mx-3 h2"  data-toggle="modal" data-target="#modal-menu"><i class="fas fa-bars"></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="overlay" class="position-relative overlay-class">
            <div id="overlay" class="overlay-img overlay-class">
                <img src="{{asset('images/cusco.jpg')}}" alt="" id="hero-vid">
                @php
                    $precio_servicio = 0;
                    $precio_servicio1 = 0;
                    $precio_hotel_s = 0;
                    $precio_hotel_d = 0;
                    $precio_hotel_m = 0;
                    $precio_hotel_t = 0;
                    $duracion=0;
                    $utilidad=0;
                @endphp
                @foreach($cotizacion as $cotizaciones)
                    @php
                        $duracion=$cotizaciones->duracion;
                    @endphp
                    @if(isset($cotizaciones))
                        @foreach($cotizaciones->paquete_cotizaciones as $paquetes)
                            @php
                                $utilidad=$paquetes->utilidad;
                            @endphp
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
                            @if($duracion>1)
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
                            @endif
                        @endforeach
                    @endif
                @endforeach
                    @php
                    $total_sh=$precio_servicio+$utilidad;
                    $precio_total_s =  $precio_servicio + $precio_hotel_s;
                    $precio_total_d =  $precio_servicio + $precio_hotel_d;
                    $precio_total_m =  $precio_servicio + $precio_hotel_m;
                    $precio_total_t =  $precio_servicio + $precio_hotel_t;

                    if($duracion>1){
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
                @foreach($cotizaciones->cotizaciones_cliente as $cliente)
                    <h5 class="font-weight-bold text-g-yellow">Hi!</h5>
                    <h1 class="font-weight-bold display-4">{{ucwords(strtolower($cliente->cliente->nombres))}}</h1>
                    <h4 class="font-weight-bold text-g-yellow">This is {{ucwords(strtolower($usuarios->name))}} i will be happy to design together a vacation </h4>
                @endforeach
            </div>
        </div>
        <div class="content-header content-header-class">
            <div class="container-fluid">
                <div class="row content-header-row content-header-row-class align-items-center">
                    <div class="col text-center">
                        <h2 class="text-white display-4">BOOKING PROCESS</h2>
                        <a href="" class="text-white"><i class="fa fa-angle-down fa-4x"></i></a>
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
                                            @if($duracion>1)
                                            <span class="{{$hide_s}}">Single ${{round($precio_total_s,2)}}</span> <span class="text-primary">|</span>
                                            <span class="{{$hide_d}}">Double ${{round($precio_total_d,2)}}</span> <span class="text-primary">|</span>
                                            <span class="{{$hide_m}}">Matrimonial ${{round($precio_total_m,2)}}</span> <span class="text-primary">|</span>
                                            <span class="{{$hide_t}}">Triple ${{round($precio_total_t,2)}}</span> <span class="text-primary">|</span>
                                            @elseif($duracion==1)
                                                <span >${{round($total_sh,2)}}</span>
                                            @endif
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
            <form id="r_form" role="form" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <h2 class="card-header h1 font-weight-bold text-g-dark">Featured</h2>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="font-weight-bold align-middle"><i class="fas fa-id-card h3 float-left mr-2"></i> Personal Information (As it appears in your passport)</h5>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="r_first"  placeholder="First Name" value="{{ucwords(strtolower($cliente->cliente->nombres))}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="r_middle"  placeholder="Middle Name" value="{{ucwords(strtolower($cliente->cliente->apellidos))}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="r_last"  placeholder="Last Name" value="{{ucwords(strtolower($cliente->cliente->apellidos))}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="r_email"  placeholder="Email" value="{{ucwords(strtolower($cliente->cliente->email))}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="r_phone"  placeholder="Phone Number" value="{{ucwords(strtolower($cliente->cliente->telefono))}}">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="r_birth"  placeholder="Date of Birth mm/dd/yyyy" value="{{ucwords(strtolower($cliente->cliente->fechanacimiento))}}">
                                        </div>
                                    </div>

                                </div>
                            </div>
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
            function register(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });
                $("#submit_tip").attr("disabled", true);
                var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
                var s_confirm = $("#r_confirm:checked").val();
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
                var s_idcliente = "{{$cliente->cliente->id}}";


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