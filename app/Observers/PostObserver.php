<?php

namespace App\Observers;

use App\Models\Post;
use Webpatser\Uuid\Uuid;

class PostObserver
{
    /**
     * Handle the Post "creating" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->id = Uuid::generate(4);
    }
}
