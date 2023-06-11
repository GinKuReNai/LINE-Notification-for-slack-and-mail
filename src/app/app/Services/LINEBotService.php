<?php

namespace App\Services;

use App\Traits\SendLineMessageTrait;

class LINEBotService
{
    use SendLineMessageTrait;

    /**
     * @param string $message
     * @param string $userId
     * @return void
     */
    public function sendLineMessageByUserId(string $message, string $userId)
    {
        $line_api_url = 'https://api.line.me/v2/bot/message/push';
        $body = [
            'to'      => $userId,
            'message' => [['type' => 'text', 'text' => $message]]
        ];

        $this->sendLineMessage($line_api_url, $body);
    }

    /**
     * @param string $message
     * @return void
     */
    public function sendLineMessageByBroadcast(string $message)
    {
        $line_api_url = 'https://api.line.me/v2/bot/message/broadcast';
        $body = [
            'messages' => [['type' => 'text', 'text' => $message]]
        ];

        $this->sendLineMessage($line_api_url, $body);
    }
}
