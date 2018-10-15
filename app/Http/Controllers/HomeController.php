<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\ItinerarioCotizaciones;
use App\ItinerarioDestinos;
use App\PaqueteCotizaciones;
use App\Proveedor;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        return dd('holaP');
    }
    public function index($idcotizacion, $idpaquete)
    {
        $cotizacion = Cotizacion::with(['paquete_cotizaciones'=>function($query)use($idpaquete){$query->where('id',$idpaquete);}])->where('id', $idcotizacion)->get();
        $paquete_p = PaqueteCotizaciones::with('itinerario_cotizaciones')->where('cotizaciones_id', $idcotizacion)->get();
        $itinerarioss = ItinerarioCotizaciones::with('itinerario_destinos')->where('paquete_cotizaciones_id', $idpaquete)->get();
        $usuario = User::get();
//        $itinerario_destino = ItinerarioDestinos::get();

        $hotel = Proveedor::with('hotel')->where('grupo', 'HOTELS')->get();
        $destinos = [];
        foreach ($itinerarioss as $itinerarios){
            foreach ($itinerarios->itinerario_destinos->where('itinerario_cotizaciones_id',$itinerarios->id) as $destino) {
//                $destinos[] = ItinerarioDestinos::where('itinerario_cotizaciones_id',$itinerarios->id)->get();
                if (!in_array($destino->destino,  $destinos))
                $destinos[] = $destino->destino;
            }

        }


        return view('home', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p, 'idpaquete'=>$idpaquete]);
    }

    public function information($idcotizacion, $idpaquete)
    {
        $cotizacion = Cotizacion::with(['paquete_cotizaciones'=>function($query)use($idpaquete){$query->where('id',$idpaquete);}])->where('id', $idcotizacion)->get();
        $paquete_p = PaqueteCotizaciones::with('itinerario_cotizaciones')->where('cotizaciones_id', $idcotizacion)->get();
        $itinerarioss = ItinerarioCotizaciones::with('itinerario_destinos')->where('paquete_cotizaciones_id', $idpaquete)->get();
        $usuario = User::get();
        $hotel = Proveedor::with('hotel')->where('grupo', 'HOTELS')->get();
        $destinos = [];
        foreach ($itinerarioss as $itinerarios){
            foreach ($itinerarios->itinerario_destinos->where('itinerario_cotizaciones_id',$itinerarios->id) as $destino) {
                if (!in_array($destino->destino,  $destinos))
                    $destinos[] = $destino->destino;
            }
        }
        return view('information', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p, 'idpaquete'=>$idpaquete]);
    }

    public function s_information(){
        $id = $_POST['txt_id'];
        $first = $_POST['txt_first'];
        $middle = $_POST['txt_middle'];
        $last = $_POST['txt_last'];
        $email = $_POST['txt_email'];
        $phone = $_POST['txt_phone'];
        $birth = $_POST['txt_birth'];
        $passport = $_POST['txt_passport'];
        $issue = $_POST['txt_issue'];
        $expiration = $_POST['txt_expiration'];
        $restriction = $_POST['txt_restriction'];

        $information = Cliente::FindOrFail($id);
        $information->nombres = $first;
        $information->apellidos = $last;
        $information->email = $email;
        $information->telefono = $phone;
        $information->fechanacimiento = $birth;
        $information->pasaporte = $passport;
        $information->emision = $issue;
        $information->expiracion = $expiration;
        $information->restricciones = $restriction;
        $information->save();
        return ("ok");
    }


    public function final($idcotizacion, $idpaquete)
    {

        $cotizacion = Cotizacion::with(['paquete_cotizaciones'=>function($query)use($idpaquete){$query->where('id',$idpaquete);}])->where('id', $idcotizacion)->get();
        $paquete_p = PaqueteCotizaciones::with('itinerario_cotizaciones')->where('cotizaciones_id', $idcotizacion)->get();
        $itinerarioss = ItinerarioCotizaciones::with('itinerario_destinos')->where('paquete_cotizaciones_id', $idpaquete)->get();
        $usuario = User::get();
//        $itinerario_destino = ItinerarioDestinos::get();

        $hotel = Proveedor::with('hotel')->where('grupo', 'HOTELS')->get();
        $destinos = [];
        foreach ($itinerarioss as $itinerarios){
            foreach ($itinerarios->itinerario_destinos->where('itinerario_cotizaciones_id',$itinerarios->id) as $destino) {
//                $destinos[] = ItinerarioDestinos::where('itinerario_cotizaciones_id',$itinerarios->id)->get();
                if (!in_array($destino->destino,  $destinos))
                    $destinos[] = $destino->destino;
            }

        }


        return view('final', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p, 'idpaquete'=>$idpaquete]);
    }

    public function checkout($idcotizacion, $idpaquete)
    {

        $cotizacion = Cotizacion::with(['paquete_cotizaciones'=>function($query)use($idpaquete){$query->where('id',$idpaquete);}])->where('id', $idcotizacion)->get();
        $paquete_p = PaqueteCotizaciones::with('itinerario_cotizaciones')->where('cotizaciones_id', $idcotizacion)->get();
        $itinerarioss = ItinerarioCotizaciones::with('itinerario_destinos')->where('paquete_cotizaciones_id', $idpaquete)->get();
        $usuario = User::get();
//        $itinerario_destino = ItinerarioDestinos::get();

        $hotel = Proveedor::with('hotel')->where('grupo', 'HOTELS')->get();
        $destinos = [];
        foreach ($itinerarioss as $itinerarios){
            foreach ($itinerarios->itinerario_destinos->where('itinerario_cotizaciones_id',$itinerarios->id) as $destino) {
//                $destinos[] = ItinerarioDestinos::where('itinerario_cotizaciones_id',$itinerarios->id)->get();
                if (!in_array($destino->destino,  $destinos))
                    $destinos[] = $destino->destino;
            }

        }


        return view('checkout', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p, 'idpaquete'=>$idpaquete]);
    }
    public function information_full($idcotizacion, $idpaquete)
    {
        $cotizacion = Cotizacion::with(['paquete_cotizaciones'=>function($query)use($idpaquete){$query->where('id',$idpaquete);}])->where('id', $idcotizacion)->get();
        $paquete_p = PaqueteCotizaciones::with('itinerario_cotizaciones')->where('cotizaciones_id', $idcotizacion)->get();
        $itinerarioss = ItinerarioCotizaciones::with('itinerario_destinos')->where('paquete_cotizaciones_id', $idpaquete)->get();
        $usuario = User::get();
        $hotel = Proveedor::with('hotel')->where('grupo', 'HOTELS')->get();
        $destinos = [];
        foreach ($itinerarioss as $itinerarios){
            foreach ($itinerarios->itinerario_destinos->where('itinerario_cotizaciones_id',$itinerarios->id) as $destino) {
                if (!in_array($destino->destino,  $destinos))
                    $destinos[] = $destino->destino;
            }
        }
        return view('information-full', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p, 'idpaquete'=>$idpaquete]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
