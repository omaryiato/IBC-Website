<?php

namespace App\Helpers;

use App\Mail\SendVerificationCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class ControlPanelOTPEmailHelper
{

    public function sendOTPNotify($email_ditals)
    {

        $view_name = 'emails.control_panel_notification';
        $subject = 'Verification Code';

        $email_address = $email_ditals['email_to'];
        $email_address = 'oalkhateeb1710@gmail.com';
        // $email_address = 'baselosama5005@gmail.com';

        $data = [
            'header' => "Ajmi Company",
            'title' => "Verification Code",
            'message' => $email_ditals['message'],
            'employee_name' => $email_ditals['employee_name'],
            'otp' => $email_ditals['otp'],
        ];

        // $emailSent = Mail::to($email_ditals['email_to'])->send(new SendVerificationCode($data));
        $emailSent = Mail::to($email_address)->send(new  SendVerificationCode($data, $view_name, $subject));

        return $emailSent;
    }

}
