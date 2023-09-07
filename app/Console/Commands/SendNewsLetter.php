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
    protected $signature = 'user:send-newsletter {user}';

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
        $user = User::find($this->argument('user')) ;
        $message = Notification::first();
        Mail::to($user->email)
            ->send(new NotificationShipped($message));
        $this->info('Enviado');
    }
}
