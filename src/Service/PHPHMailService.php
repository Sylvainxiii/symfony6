<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;

class PHPMailService extends \PHPMailer\PHPMailer\PHPMailer
{
    public function __construct()
    {
        //configuration
        $this->isSMTP();                                            //Send using SMTP
        $this->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->Username   = 'scaleautoperfect@gmail.com';                     //SMTP username
        $this->Password   = 'hfjjcunhgurckcag';                               //SMTP password
        $this->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->Port       = 465;
    }
}
