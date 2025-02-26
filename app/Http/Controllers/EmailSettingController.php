<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailSetting;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class EmailSettingController extends Controller
{
    // Show the settings form & test mail form
    public function index()
    {
        $settings = EmailSetting::first();
        return view('email-settings', compact('settings'));
    }

    // Update email settings in the database
    public function update(Request $request)
    {
        $request->validate([
            'mailer' => 'required|string',
            'host' => 'required|string',
            'port' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'encryption' => 'nullable|string',
            'from_address' => 'required|email',
            'from_name' => 'required|string',
        ]);

        $settings = EmailSetting::firstOrNew();
        $settings->mailer = $request->mailer;
        $settings->host = $request->host;
        $settings->port = $request->port;
        $settings->username = $request->username;
        $settings->password = $request->password;
        $settings->encryption = $request->encryption;
        $settings->from_address = $request->from_address;
        $settings->from_name = $request->from_name;
        $settings->save();

        Session::flash('success', 'Email settings updated successfully!');
        return redirect()->route('email-settings.index');
    }

    // Set mail configuration dynamically
    public static function setMailConfig()
    {
        $settings = EmailSetting::first();

        if ($settings) {
            Config::set('mail.mailers.smtp.transport', $settings->mailer);
            Config::set('mail.mailers.smtp.host', $settings->host);
            Config::set('mail.mailers.smtp.port', $settings->port);
            Config::set('mail.mailers.smtp.username', $settings->username);
            Config::set('mail.mailers.smtp.password', $settings->password);
            Config::set('mail.mailers.smtp.encryption', $settings->encryption);
            Config::set('mail.from.address', $settings->from_address);
            Config::set('mail.from.name', $settings->from_name);

            Log::info('Mail settings updated:', config('mail.mailers.smtp'));

            return "Mail configuration updated successfully.";
        }

        return "No email settings found.";
    }

    public function sendTestEmail(Request $request)
    {
        // Set the mail config dynamically
        self::setMailConfig();

        // Log the applied settings
        Log::info('Mail configuration:', config('mail.mailers.smtp'));

        // Validate the email input
        $request->validate([
            'to_email' => 'required|email',
        ]);

        try {
            // Send email
            Mail::raw('This is a test email.', function ($message) use ($request) {
                $message->to($request->to_email)
                        ->subject('Test Email');
            });

            return back()->with('success', 'Test email sent successfully to ' . $request->to_email);
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}
