<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioHotelReservaPagos extends Model
{
    protected $table = "precio_hotel_reserva_pago";
    public function hotel_pago()
    {
        return $this->belongsTo(PrecioHotelReserva::class, 'precio_hotel_reserva_id');
    }
}
