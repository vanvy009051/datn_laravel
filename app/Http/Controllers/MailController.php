<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_mail()
    {
        //send mail
        $to_name = "Electro Shop";
        $to_email = "nguyenvanvy1509@gmail.com"; //send to this email

        $data = array("name" => "Email từ khách hàng", "body" => "Email về vấn đề"); //body of mail.blade.php

        Mail::send('pages.send_mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email)->subject('test mail nhé'); //send this mail with subject
            $message->from($to_email, $to_name); //send from this mail
        });
        //--send mail
    }
}
