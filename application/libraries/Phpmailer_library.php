<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Phpmailer_library
{
    public function __construct()
    {
       // log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        require_once(APPPATH."third_party/PhpMailer/class.phpmailer.php");
        $mail = new PHPMailer;
        $mail->IsSMTP();
        return $mail;
    }
}