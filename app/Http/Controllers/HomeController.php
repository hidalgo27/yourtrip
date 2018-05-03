<?php

namespace App\Http\Controllers;

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
