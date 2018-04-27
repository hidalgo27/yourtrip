<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteCotizaciones extends Model
{
    //
    protected $table = "paquete_cotizaciones";

    public function cotizaciones()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizaciones_id');
    }
    public function paquete_precios()
    {
        return $this->hasMany(PaquetePrecio::class, 'paquete_cotizaciones_id');
    }
    public function paquete_incluye()
    {
        return $this->hasMany(PaqueteIncluye::class, 'paquete_cotizaciones_id');
    }
    public function paquete_servicio()
    {
        return $this->hasMany(PaqueteServicio::class, 'paquete_cotizaciones_id');
    }
    public function itinerario_cotizaciones()
    {
        return $this->hasMany(ItinerarioCotizaciones::class, 'paquete_cotizaciones_id');
    }
}
