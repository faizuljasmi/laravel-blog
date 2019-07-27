<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class GenerateSlug
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  App\PostCreated  $event
     * @return void
     */
    public function handle($event)
    {
        $title = $event->post->title;
        $post_id = $event->post->id;
        $slug = Str::slug($title).'-'.$post_id;
        $event->post->update(compact('slug'));
    }
}
