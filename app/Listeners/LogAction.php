<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ActionLogged;
use App\Models\Log;

class LogAction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ActionLogged $event)
    {
        Log::create([
            'user_id' => $event->userId,
            'action' => $event->action,
            'timestamp' => now(),
        ]);
    }
}
