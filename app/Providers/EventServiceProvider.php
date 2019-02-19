<?php

namespace App\Providers;

use App\Events\NoteCreating;
use App\Listeners\SetPositionOnNewNote;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NoteCreating::class => [
            SetPositionOnNewNote::class,
        ],
    ];
}
