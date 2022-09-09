<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\{DetailPlan, Permission, Plan, Post, Profile, Tenant, User};
use App\Observers\{DetailPlanObserve,
    PermissionObserver,
    PlanObserve,
    PostObserver,
    ProfileObserver,
    TenantObserver,
    UserObserver};

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Tenant::observe(TenantObserver::class);
        Post::observe(PostObserver::class);
        Plan::observe(PlanObserve::class);
        DetailPlan::observe(DetailPlanObserve::class);
        Profile::observe(ProfileObserver::class);
        Permission::observe(PermissionObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
