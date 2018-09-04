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
                                @if($paquete_precio->personas_s>0)
                                    @php
                                        $utilidad_s = $paquete_precio->utilidad_s;
                                        $precio_hotel_s = $precio_hotel_s + ($paquete_precio->precio_s * ($cotizaciones->duracion - 1)) + $utilidad_s;
                                    @endphp
                                @endif
                                @if($paquete_precio->personas_d>0)
                                    @php
                                        $utilidad_d = $paquete_precio->utilidad_d;
                                        $precio_hotel_d = $precio_hotel_d + (($paquete_precio->precio_d/2) * ($cotizaciones->duracion - 1)) + $utilidad_d;
                                    @endphp
                                @endif
                                @if($paquete_precio->personas_m>0)
                                    @php
                                        $utilidad_m = $paquete_precio->utilidad_m;
                                        $precio_hotel_m = $precio_hotel_m + (($paquete_precio->precio_m/2) * ($cotizaciones->duracion - 1)) + $utilidad_m;
                                    @endphp
                                @endif
                                @if($paquete_precio->personas_t>0)
                                    @php
                                        $utilidad_t = $paquete_precio->utilidad_t;
                                        $precio_hotel_t = $precio_hotel_t + (($paquete_precio->precio_t/3) * ($cotizaciones->duracion - 1)) + $utilidad_t;
                                    @endphp
                                @endif
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
                                <h4 class="font-weight-bold">(+51)84262555</h4>
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
                @foreach($cotizaciones->cotizaciones_cliente->where('estado','1') as $cliente)
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
                    @php
                        $total_campos=13;
                    @endphp
                    @foreach($cotizacion as $cotizacion_)
                        @php
                            $nro_pax=0;
                        @endphp
                        @foreach($cotizacion_->cotizaciones_cliente->sortByDesc('estado') as $cotizacion_cliente)
                            @php
                                $total_campos_llenados=0;
                                $nro_pax++;
                            @endphp
                            @if(trim($cotizacion_cliente->cliente->nombres)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->apellidos)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->sexo)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->email)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->telefono)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->nacionalidad)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->fechanacimiento)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->pasaporte)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->pasaporte_imagen)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->expiracion)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->restricciones)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->contact)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @if(trim($cotizacion_cliente->cliente->contact_telefono)!='')
                                @php
                                    $total_campos_llenados++;
                                @endphp
                            @endif
                            @php
                                $total=round(($total_campos_llenados/$total_campos)*100);
                                $color='text-warning';
                                $completo='Incomplete';
                            @endphp
                            @if($total==100)
                                @php
                                    $color='text-success';
                                    $completo='Complete';
                                @endphp
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="circulo">
                                            <img src="{{asset('images/logos/logo-ave-gotoperu.png')}}" alt="" class="img-fluid">
                                            <b class="{{$color}} text-22">{{$completo}}</b>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p>
                                            <b class="text-primary text-22">
                                                @if(trim($cotizacion_cliente->cliente->nombres)=='')
                                                    Pax {{$nro_pax}}
                                                @else
                                                    {{$cotizacion_cliente->cliente->nombres}}, {{$cotizacion_cliente->cliente->apellidos}}
                                                @endif
                                            </b>
                                        </p>
                                        <a class="btn btn-primary" href="{{route('information_path',[$idcotizacion,$idpaquete,$cotizacion_cliente->cliente->id,1,'s'])}}">
                                            Fill Information</b>
                                        </a>
                                        @if($cotizacion_cliente->estado==0)
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Modal_pedir_info_{{$cotizacion_cliente->cliente->id}}">
                                            Request information
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal_pedir_info_{{$cotizacion_cliente->cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form id="ask_request_{{$cotizacion_cliente->cliente->id}}" action="{{route('ask_information_path')}}" method="post">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Request Information</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-auto">
                                                                <div class="input-group mb-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">Name</div>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="r_name" name="r_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="input-group mb-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">Email</div>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="r_email" name="r_email">
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <b id="response_{{$cotizacion_cliente->cliente->id}}" class="text-22"></b>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="estado" value="0">
                                                            <input type="hidden" name="cotizacion_id" value="{{$idcotizacion}}">
                                                            <input type="hidden" name="pqt_id" value="{{$idpaquete}}">
                                                            <input type="hidden" name="cliente_id" value="{{$cotizacion_cliente->cliente->id}}">
                                                            {{csrf_field()}}
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" onclick="enviar_ask_request('{{$cotizacion_cliente->cliente->id}}')">Send</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                            <button type="button" class="btn btn-unset" data-toggle="modal" data-target="#Modal_pedir_info_{{$cotizacion_cliente->cliente->id}}" readonly="readonly">
                                                Request information
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 d-none">
                                <div class="row text-center border dark">

                                </div>
                            </div>
                        @endforeach
                    @endforeach
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
    @push('scripts')
        <script>
            function enviar_ask_request(cliente_id){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                });
                $.ajax({
                    type:  'post',
                    url:   $('#ask_request_'+cliente_id).attr('action'),
                    data:  $('#ask_request_'+cliente_id).serialize(),
                    beforeSend:function(res){
                        $('#response_'+cliente_id).html('<i class="fa fa-circle-o-notch fa-spin"></i>Loading');
                    }
                    ,success:  function (response) {
                        console.log('response:'+response);
                        if(response=='1'){
                            $('#response_'+cliente_id).removeClass('text-danger');
                            $('#response_'+cliente_id).addClass('text-success');
                            $('#response_'+cliente_id).html('E-mail send!');
                        }
                        else if(response=='0'){
                            $('#response_'+cliente_id).removeClass('text-success');
                            $('#response_'+cliente_id).addClass('text-danger');
                            $('#response_'+cliente_id).html('Error sending email!');
                        }
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
                var s_contact= $('#r_full').val();
                var s_contact_telefono = $('#r_contact').val();

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