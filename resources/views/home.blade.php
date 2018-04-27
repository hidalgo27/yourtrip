@extends('layouts.default')

@section('content')

    <section class="header-video d-none d-md-block">
        <div id="title" class="text-white">
            <div class="container-fluid">
                <div class="row justify-content-between mt-2">
                    <div class="col-md-6 col-lg-3">
                        <a href="{{route('home_path')}}"><img src="{{asset('images/logos/logo-gotoperu-ave-w.png')}}" alt="" class="img-fluid"></a>
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
                            <div class="rounded bg-rgba-dark-1 p-4">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{asset('images/team/doriam.jpg')}}" alt="" class="rounded-circle img-fluid">
                                    </div>
                                    <div class="col">
                                        <h4 class="font-weight-bold m-0">Doriam Perez</h4>
                                        <h6 class="">doriam@gotoperu.com</h6>
                                        <h4 class="font-weight-bold">(51)980476535</h4>
                                        <a href="" class="btn btn-outline-light">More about me</a>
                                    </div>
                                </div>
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

            </div>

            <div class="header-expedia p-3 w-100 d-none d-lg-inline text-white">
                {{--<p class="text-white h6"><span class="bg-g-green p-1 rounded-circle px-3 text-white">1</span> Share your travel plans <span class="bg-g-yellow p-1 rounded-circle px-3 text-white ml-5">2</span> Receive a customize itinerary and quote <span class="bg-g-dark p-1 rounded-circle px-3 text-white ml-5">3</span> Discover the best of Peru with GOTOPERU</p>--}}
                <h1 class="font-weight-bold display-4">Hi Douglas O'Brien</h1>
                <h4 class="font-weight-bold">My name is Doriam,</h4>
                <h4 class="font-weight-bold">I'm your personal Travel Advisor</h4>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row content-header-row align-items-center">
                    <div class="col text-center">
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
    @foreach($paquete->where('id', 156) as $paquetes)
    @endforeach
    <section class="bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div id="overview">
                        <div class="row">
                            <div class="col-8">
                                <h2 class="pt-5 mb-4 display-4 font-weight-bold text-g-dark">Overview</h2>
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
                                        <h5>15 March 2018</h5>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h3 class="font-weight-bold text-right">Departure</h3>
                                    </div>
                                    <div class="col">
                                        <h5>18 March 2018</h5>
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
                            <div class="col sticky-top-50">
                                <div class="rounded bg-rgba-dark-1 p-4 sticky-top sticky-top-50">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{asset('images/team/doriam.jpg')}}" alt="" class="rounded-circle img-fluid">
                                        </div>
                                        <div class="col">
                                            <h4 class="font-weight-bold m-0">Doriam Perez</h4>
                                            <h6 class="">doriam@gotoperu.com</h6>
                                            <h4 class="font-weight-bold">(51)980476535</h4>
                                            <a href="" class="btn btn-outline-g-dark">More about me</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div id="Itinerary">
                        <div class="row">
                            <div class="col-8">
                                <h2 class="pt-5 mb-4 display-4 font-weight-bold text-g-green">Itinerary</h2>
                                @php
                                    $i = 1;
                                    $num_des = count($paquetes->itinerario_cotizaciones);
                                @endphp
                                @foreach($paquetes->itinerario_cotizaciones->sortBy('dia') as $itinerario)
                                    <div class="timeline @php if($i == $num_des) echo 'timeline-f' @endphp">
                                        <div class="timeline-title">
                                            <span class="rounded-circle bg-g-green text-white py-4 font-weight-bold">DAY {{$itinerario->dias}}</span>
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
                    <div id="Hotels">

                    </div>
                    <div id="Prices">
                        <div class="row">
                            <div class="col-8">
                                <h2 class="pt-5 mb-4 display-4 font-weight-bold text-danger">Prices</h2>
                                <h5>Prices Per Person <small class="text-primary font-weight-bold">($USD)</small></h5>
                                <div class="card border-secondary">
                                    <p class="card-header bg-dark text-g-yellow">Based on doble / triple occupancy </p>
                                    <div class="card-body p-0">
                                        <table class="table m-0">
                                            <thead class="title-header bg-light">
                                            <tr>
                                                <th>2 Stars</th>
                                                <th>3 Stars</th>
                                                <th>4 Stars</th>
                                                <th>5 Stars</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                {{--@foreach($paquetes->precio_paquetes->sortBy('estrellas') as $precio)--}}
                                                    {{--@if($precio->precio_d > 0)--}}
                                                        {{--<td>--}}
                                                            {{--<sup>$</sup>{{$precio->precio_d}}--}}
                                                        {{--</td>--}}
                                                    {{--@else--}}
                                                        {{--<td class="text-danger">--}}
                                                            {{--Inquire--}}
                                                        {{--</td>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}

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


                                <div id="why">
                                    <div class="row">
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
                                                    <p>(678) 894-9878</p>
                                                    <p><a class="btn-link" href="#" role="button">megan@latinamericaforless.com</a></p>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col sticky-top-50">
                                <div class="rounded bg-rgba-dark-1 p-4 sticky-top sticky-top-50">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{asset('images/team/doriam.jpg')}}" alt="" class="rounded-circle img-fluid">
                                        </div>
                                        <div class="col">
                                            <h4 class="font-weight-bold m-0">Doriam Perez</h4>
                                            <h6 class="">doriam@gotoperu.com</h6>
                                            <h4 class="font-weight-bold">(51)980476535</h4>
                                            <a href="" class="btn btn-outline-g-dark">More about me</a>
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