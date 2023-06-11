<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NotificationService;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:send_notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a message to a LINE channel';

    /**
     * @var NotificationService
     */
    protected $notificationService;

    public function __construct(NotificationService $service)
    {
        parent::__construct();

        $this->notificationService = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->notificationService->sendNotificationByBroadcast();

        $this->info('Notifications sent successfully!');

        return 0;
    }
}
