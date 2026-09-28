<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use App\Models\JadwalPosyandu;
use Illuminate\Support\Facades\Mail;
use App\Mail\JadwalPosyanduMail;

class KirimReminderPosyandu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:kirim-reminder-posyandu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim reminder jadwal posyandu H-1 ke semua user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $besok = Carbon::tomorrow()->toDateString();

        $jadwals = JadwalPosyandu::whereDate('waktu_mulai', $besok)->get();

        if ($jadwals->isEmpty()) {
            $this->info('Tidak ada jadwal posyandu untuk besok.');
            return;
        }

        $users = User::whereNotNull('email')->get();

        foreach ($jadwals as $jadwal) {

            foreach ($users as $user) {

                Mail::to($user->email)
                    ->send(new JadwalPosyanduMail($user, $jadwal));

                $this->info("Email berhasil dikirim ke {$user->email}");
            }
        }

        $this->info('Semua reminder jadwal posyandu berhasil dikirim.');
    }
}