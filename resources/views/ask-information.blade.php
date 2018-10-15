@extends('layouts.inquire')
@section('content')
<tr>
    <td>
        Dear {{$name}},<br>
        Below you will find a secure link to fill your personal information in order to complete bookings.<br>
        <a href="{{route('information_path',[$cotizacion_id,$pqt_id,$cliente_id,$estado,'s'])}}" target="_blank">Fill Information</a>
        <p>If you need any assistance please dont hesitate to contact us.</p>
        <p>Cordially</p>
        <p>GOTOPERU</p>
    </td>
</tr>
@stop
