<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // Khai báo biến công khai để dùng trong giao diện mail

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Mã xác minh tài khoản của bạn')
                    ->html("<h3>Mã OTP của bạn là: <b style='color:blue; font-size:24px;'>{$this->otp}</b></h3><p>Mã này sẽ hết hạn sau 5 phút.</p>");
    }
}