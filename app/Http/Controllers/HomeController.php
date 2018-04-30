<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\ItinerarioDestinos;
use App\PaqueteCotizaciones;
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
        $paquete = PaqueteCotizaciones::with('itinerario_cotizaciones')->get();
        $usuario = User::get();
        $itinerario_destino = ItinerarioDestinos::get();
        return view('home', ['paquete'=>$paquete, 'cotizacion'=>$cotizacion, 'usuario'=>$usuario]);
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
