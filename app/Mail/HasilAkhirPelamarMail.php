<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HasilAkhirPelamarMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pelamar;
    protected $pdfContent;
    protected $pdfName;

    public function __construct($pelamar, $pdfContent = null, $pdfName = null)
    {
        $this->pelamar = $pelamar;
        $this->pdfContent = $pdfContent;
        $this->pdfName = $pdfName;
    }

    public function build()
    {
        $mail = $this->subject('Hasil Seleksi & Ranking Beasiswa')
            ->view('admin.emails.hasil_akhir_pelamar');
        if ($this->pdfContent && $this->pdfName) {
            $mail->attachData($this->pdfContent, $this->pdfName, [
                'mime' => 'application/pdf',
            ]);
        }
        return $mail;
    }
}
