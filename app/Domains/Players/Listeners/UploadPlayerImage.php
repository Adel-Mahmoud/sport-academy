<?php

namespace App\Domains\Players\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Domains\Players\Events\PlayerCreated;

class UploadPlayerImage
{
    public bool $afterCommit = true;

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
    public function handle(PlayerCreated $event)
    {
        if (!$event->tempImagePath) {
            return;
        }

        $newPath = str_replace('temp/', 'players/', $event->tempImagePath);

        Storage::disk('public')->move(
            $event->tempImagePath,
            $newPath
        );

        $event->player->update([
            'image' => $newPath
        ]);
    }
}
