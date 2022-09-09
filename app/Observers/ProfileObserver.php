<?php

namespace App\Observers;

use App\Models\Profile;
use Webpatser\Uuid\Uuid;


class ProfileObserver
{
    /**
     * Handle the Profile "created" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function creating(Profile $profile)
    {
        $profile->id = Uuid::generate(4);
    }


}
