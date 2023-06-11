<?php

namespace App\Services;

use App\Services\LINEBotService;

class NotificationService
{
    /**
     * @var LINEBotService
     */
    protected $lineBotService;

    /**
     * @var string
     */
    protected $message = "昨日のメールを教えるね！昨日は--件のメールがきたよ！";

    public function __construct(LINEBotService $service)
    {
        $this->lineBotService = $service;
    }

    /**
     * Send email notifications to specific user
     * @param string $userId
     * @return void
     */
    public function sendNotificationByUserId(string $userId)
    {
        $this->lineBotService->sendLineMessageByUserId($this->message, $userId);
    }

    /**
     * Send email notifications by multicast
     */
    public function sendNotificationByBroadcast()
    {
        $this->lineBotService->sendLineMessageByBroadcast($this->message);
    }
}
