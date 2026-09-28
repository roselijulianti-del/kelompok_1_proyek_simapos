<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoTransportFactory;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
        ;

        Mail::extend('brevo', function (array $config) {
            // Tambahkan pengecekan agar errornya lebih jelas jika key lupa diisi
            $key = $config['key'] ?? env('BREVO_API_KEY');

            if (!$key) {
                throw new \Exception("Chika, BREVO_API_KEY belum diisi di Railway!");
            }

            return (new BrevoTransportFactory)->create(
                new Dsn('brevo+api', 'default', $key)
            );
        });
    }
}
