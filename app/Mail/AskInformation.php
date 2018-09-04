<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AskInformation extends Mailable
{
    public $cotizacion_id;
    public $pqt_id;
    public $cliente_id;
    public $email;
    public $name;
    public $estado;

    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cotizacion_id,$pqt_id,$cliente_id,$email,$name,$estado)
    {
        //
        $this->cotizacion_id=$cotizacion_id;
        $this->pqt_id=$pqt_id;
        $this->cliente_id=$cliente_id;
        $this->email=$email;
        $this->name=$name;
        $this->estado=$estado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ask-information',['cotizacion_id'=>$this->cotizacion_id,'pqt_id'=>$this->pqt_id,'cliente_id'=>$this->cliente_id,'estado'=>$this->estado])
//            ->with($this->nombre,$this->cliente)
            ->to($this->email,$this->name)
            ->from('booking@gotoperu.com','GotoPeru')
//            ->from('fredy1432@gmail.com','GotoPeru')
            ->subject('More Information (GotoPeru)');
    }
}
