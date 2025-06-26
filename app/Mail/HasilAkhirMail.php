<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HasilAkhirMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hasilAkhir;

    public function __construct($hasilAkhir)
    {
        $this->hasilAkhir = $hasilAkhir;
    }

    public function build()
    {
        return $this->subject('Hasil Akhir Peringkat Seleksi')
                    ->view('admin.emails.hasil_akhir.index');
    }
}
