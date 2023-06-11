<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SendLineMessageTrait
{
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
