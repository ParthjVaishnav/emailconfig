<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Config;

class MailConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Set Mail Configuration Dynamically
        Config::set('mail.default', 'smtp');
        Config::set('mail.mailers.smtp', [
            'transport' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'username' => 'parthvaishnav81@gmail.com',
            'password' => 'smtjuaywcnxydega',
            'encryption' => 'tls',
            'timeout' => null,
            'auth_mode' => null,
        ]);
    }

    public function boot()
    {
        //
    }
}
