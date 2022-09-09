<?php

namespace App\Observers;

use App\Models\Permission;
use Webpatser\Uuid\Uuid;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function creating(Permission $permission)
    {
        $permission->id = Uuid::generate(4);
    }


}
