<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\ItinerarioCotizaciones;
use App\ItinerarioDestinos;
use App\Mail\AskInformation;
use App\PaqueteCotizaciones;
use App\Proveedor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

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
    public function information($idcotizacion, $idpaquete,$cliente_id,$estado,$confirm)
    {
        $cliente=Cliente::find($cliente_id);
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
        return view('information', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p,'idcotizacion'=>$idcotizacion, 'idpaquete'=>$idpaquete,'cliente'=>$cliente,'estado'=>$estado,'confirm'=>$confirm]);
    }
    public function information_full($idcotizacion, $idpaquete)
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
        return view('information_full', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p, 'idpaquete'=>$idpaquete,'idcotizacion'=>$idcotizacion]);
    }
    public function information_edit($idcotizacion, $idpaquete)
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
        return view('information_edit', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p, 'idpaquete'=>$idpaquete,'idcotizacion'=>$idcotizacion]);
    }
    public function s_information(Request $request){
        $cliente_estado=$request->input('estado');
        $cotizacion_id=$request->input('cotizacion_id');
        $pqt_id=$request->input('pqt_id');
        $id = $request->input('r_id');
        $nacionalidad = $request->input('r_nacionality');
        $first = $request->input('r_first');
        $last = $request->input('r_last');
        $genero= $request->input('r_genero');
        $email = $request->input('r_email');
        $phone = $request->input('r_phone');
        $birth = $request->input('r_birth');
        $passport = $request->input('r_passport');
        $expiration = $request->input('r_expiration');
        $passport_foto = $request->file('r_passport_foto');
        $restriction = $request->input('r_restriction');
        $contact = $request->input('r_contact');
        $contact_telefono= $request->input('r_contact_phone');
        $information = Cliente::FindOrFail($id);
        $information->nacionalidad= $nacionalidad;
        $information->nombres = $first;
        $information->apellidos = $last;
        $information->sexo= $genero;
        $information->email = $email;
        $information->telefono = $phone;
        $information->fechanacimiento = $birth;
        $information->pasaporte = $passport;
        $information->expiracion = $expiration;
        $information->restricciones = $restriction;
        $information->contact = $contact;
        $information->contact_telefono = $contact_telefono;
        $information->save();
        if($passport_foto){
            $filename ='photo-'.$information->id.'.jpg';
            $information->pasaporte_imagen=$filename;
            $information->save();
            Storage::disk('passport_photo')->put($filename,  File::get($passport_foto));
        }

        if($cliente_estado=='1')
            return redirect()->route('information_full_path',[$cotizacion_id,$pqt_id]);
        else
            return redirect()->route('information_path',[$cotizacion_id,$pqt_id,$id,$cliente_estado,'c']);

    }
    public function final_($idcotizacion, $idpaquete)
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
        $hotel = Proveedor::with('hotel')->where('grupo', 'HOTELS')->get();
        $destinos = [];
        foreach ($itinerarioss as $itinerarios){
            foreach ($itinerarios->itinerario_destinos->where('itinerario_cotizaciones_id',$itinerarios->id) as $destino) {
                if (!in_array($destino->destino,  $destinos))
                    $destinos[] = $destino->destino;
            }
        }
        return view('checkout', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p, 'idpaquete'=>$idpaquete]);
    }
//    public function information_full($idcotizacion, $idpaquete)
//    {
//        $cotizacion = Cotizacion::with(['paquete_cotizaciones'=>function($query)use($idpaquete){$query->where('id',$idpaquete);}])->where('id', $idcotizacion)->get();
//        $paquete_p = PaqueteCotizaciones::with('itinerario_cotizaciones')->where('cotizaciones_id', $idcotizacion)->get();
//        $itinerarioss = ItinerarioCotizaciones::with('itinerario_destinos')->where('paquete_cotizaciones_id', $idpaquete)->get();
//        $usuario = User::get();
//        $hotel = Proveedor::with('hotel')->where('grupo', 'HOTELS')->get();
//        $destinos = [];
//        foreach ($itinerarioss as $itinerarios){
//            foreach ($itinerarios->itinerario_destinos->where('itinerario_cotizaciones_id',$itinerarios->id) as $destino) {
//                if (!in_array($destino->destino,  $destinos))
//                    $destinos[] = $destino->destino;
//            }
//        }
//        return view('information-full', ['cotizacion'=>$cotizacion, 'usuario'=>$usuario, 'itinerarioss'=>$itinerarioss, 'destinos'=>$destinos, 'hotel'=>$hotel, 'paquete_p'=>$paquete_p, 'idpaquete'=>$idpaquete]);
//    }
    public function getCotiArchivosImageName($filename){
        $file = Storage::disk('passport_photo')->get($filename);
        return new Response($file, 200);
    }
    public function ask_information(Request $request){
        $cliente_estado=$request->input('estado');
        $cotizacion_id=$request->input('cotizacion_id');
        $pqt_id=$request->input('pqt_id');
        $cliente_id=$request->input('cliente_id');
        $email=$request->input('r_email');
        $name=$request->input('r_name');
        $email_send=Mail::to($email,$name)->send(new AskInformation($cotizacion_id,$pqt_id,$cliente_id,$email,$name,$cliente_estado));
        return 1;
   }

}
