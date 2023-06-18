<?php

namespace App\Services;

use App\Traits\SendLineMessageTrait;
use Illuminate\Support\Facades\Http;

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

    /**
     * Send line message
     *
     * @param string $url
     * @param array $body
     * @return void
     */
    public function sendLineMessage(string $url, array $body)
    {
        $headers = [
            'Authorization' => 'Bearer ' . config('line.message.line_bot_channel_access_token'),
            'Content-Type'  => 'application/json',
        ];

        $response = Http::withHeaders($headers)->post($url, $body);

        if ($response->getStatusCode() != 200) {
            logger()->error('Failed to send message.', [
                'status' => $response->getStatusCode(),
                'body'   => $response->getBody(),
            ]);
        }
    }
}
