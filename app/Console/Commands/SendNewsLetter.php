<?php

namespace App\Console\Commands;

use App\Mail\NotificationShipped;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:send-newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notification = Notification::where('title', 'Nueva actualización del sistema')->first();

        if (!$notification) {
            $this->error('No se encontró la notificación.');
            return;
        }
        for ($i = 0; $i < 5; $i++) {
            $users = User::where('email_sent', false)
                ->take(100)
                ->get();

            foreach ($users as $user) {
                Mail::to($user->email)->send(new NotificationShipped($notification));
                $user->update(['email_sent' => true]);
            }
            $this->info('Correo promocional enviado a ' . count($users) . ' usuarios.');
        }
    }
}
