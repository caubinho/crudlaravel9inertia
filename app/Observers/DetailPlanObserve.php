<?php

namespace App\Observers;

use App\Models\DetailPlan;
use Webpatser\Uuid\Uuid;

class DetailPlanObserve
{
    /**
     * Handle the DetailPlan "creating" event.
     *
     * @param  \App\Models\DetailPlan  $detailPlan
     * @return void
     */
    public function creating(DetailPlan $detailPlan)
    {
        $detailPlan->id = Uuid::generate(4);
    }

}
