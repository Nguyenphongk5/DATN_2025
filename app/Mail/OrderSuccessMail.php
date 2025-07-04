<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
   use Queueable, SerializesModels;

    public $name, $phone, $address, $note, $total, $payment_method;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->phone = $data['phone'];
        $this->address = $data['address'];
        $this->note = $data['note'];
        $this->total = $data['total'];
        $this->payment_method = $data['payment_method'];
    }

    public function build()
    {
        return $this->subject('Xác nhận đặt hàng')
                    ->view('emails.orders.success')
                    ->with([
                    'name' => $this->name,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'note' => $this->note,
                    'total' => $this->total,
                    'payment_method' => $this->payment_method,
                ]);
    }
}
