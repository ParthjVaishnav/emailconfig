<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Http\Controllers\EmailSettingController;

class MailTestController extends Controller
{
    public function sendTestEmail()
    {
        // Apply mail configuration before sending
        EmailSettingController::setMailConfig();

        $toEmail = "test@example.com"; // Replace with a real email
        Mail::to($toEmail)->send(new TestMail());

        return "Test email sent successfully to {$toEmail}";
    }
}

