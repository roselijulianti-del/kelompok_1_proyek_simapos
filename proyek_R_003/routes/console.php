<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Penjadwalan pengiriman email ke setiap user pada h-1 sebelum jadwal posyandu
Schedule::command('app:kirim-reminder-posyandu')->everyMinute();
// Schedule::command('app:kirim-reminder-posyandu')->daily();