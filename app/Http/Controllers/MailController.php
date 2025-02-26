<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'customer_email' => 'required|email',
            'message' => 'required',
        ]);

        $details = [
            'title' => 'Customer Message',
            'body' => $request->message
        ];

        Mail::raw($request->message, function ($message) use ($request) {
            $message->to($request->customer_email)
                    ->subject('Message from Our System');
        });

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
