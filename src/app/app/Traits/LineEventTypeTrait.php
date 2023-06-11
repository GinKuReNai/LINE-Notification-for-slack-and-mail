<?php

namespace App\Traits;

use App\Models\LineUser;

trait LineEventTypeTrait
{
    /**
     * Invoke the handler method for a specific event type
     *
     * @param array $event
     * @return void
     */
    private function handleEventType(array $event)
    {
        $handlerMethod = 'on' . ucfirst($event['type']);

        if (method_exists($this, $handlerMethod)) {
            $this->$handlerMethod($event);
        }
    }

    /**
     * Handle 'follow' event
     *
     * @param array $event
     * @return void
     */
    private function onFollow(array $event)
    {
        LineUser::updateOrCreate(['line_id' => $event['source']['userId']]);
    }

    /**
     * Handle 'unblock' event by invoking the 'follow' event handler
     *
     * @param array $event
     * @return void
     */
    private function onUnblock(array $event)
    {
        $this->onFollow($event);
    }

    /**
     * Handle 'unfollow' event
     *
     * @param array $event
     * @return void
     */
    private function onUnfollow(array $event)
    {
        LineUser::where('line_id', $event['source']['userId'])->delete();
    }

    /**
     * Handle 'block' event by invoking the 'unfollow' event handler
     *
     * @param array $event
     * @return void
     */
    private function onBlock(array $event)
    {
        $this->onUnfollow($event);
    }
}
