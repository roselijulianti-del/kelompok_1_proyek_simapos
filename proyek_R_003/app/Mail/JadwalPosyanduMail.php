<?php

namespace App\Mail;

use App\Models\User;
use App\Models\JadwalPosyandu;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class JadwalPosyanduMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $jadwal;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, JadwalPosyandu $jadwal)
    {
        $this->user = $user;
        $this->jadwal = $jadwal;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reminder Jadwal Posyandu',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content();
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Reminder Jadwal Posyandu')
            ->html("
                <h2>Halo {$this->user->name}</h2>

                <p>Ini adalah pengingat jadwal Posyandu besok.</p>

                <p><strong>Keterangan:</strong> {$this->jadwal->keterangan}</p>
                <p><strong>Lokasi:</strong> {$this->jadwal->lokasi}</p>
                <p><strong>Waktu Mulai:</strong> {$this->jadwal->waktu_mulai}</p>
                <p><strong>Waktu Selesai:</strong> {$this->jadwal->waktu_selesai}</p>

                <br>

                <p>Silakan datang sesuai jadwal yang telah ditentukan.</p>

                <br>

                <p>Terima kasih.</p>
            ");
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
