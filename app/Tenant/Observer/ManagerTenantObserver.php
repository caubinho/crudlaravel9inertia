<?php

namespace App\Tenant\Observer;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class ManagerTenantObserver
{
    public function creating(Model $model)
    {
        $tenant= app(ManagerTenant::class)->getTenantIdentify();
        $model->setAttribute('tenant_id', $tenant );
    }
}
