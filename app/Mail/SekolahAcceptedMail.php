<?php

namespace App\Mail;

use App\Models\Sekolah;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SekolahAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sekolah;

    public function __construct(Sekolah $sekolah)
    {
        $this->sekolah = $sekolah;
    }

    public function build()
    {
        return $this->subject('Sekolah Diterima')
                    ->view('emails.sekolah-accepted');
    }
}
