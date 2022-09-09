<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;


require __DIR__.'/auth.php';

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::prefix('dashboard')
    ->middleware(['auth', 'verified'])
    ->group(function () {


        /**
         *  permissions x profile
         */
        Route::get('/profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profile.permission.detach');
        Route::post('/profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'] )->name('profile.permissions.attach');
        Route::any('/profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'] )->name('profile.permissions.available');
        Route::get('/profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'] )->name('profile.permissions');
        /**
         * permission
         */

        Route::resource('permissions', PermissionController::class);



        /**
         * profiles
         */

        Route::resource('profiles', ProfileController::class);

        /**
         *  plan x details
         */
        Route::delete('plans/{id}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('detail.plan.destroy');
        Route::put('plans/{id}/details/{idDetail}', [ DetailPlanController::class, 'update'])->name('detail.plan.update');
        Route::get('plans/{id}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('detail.plan.edit');
        Route::post('/plans/{id}/details/create', [DetailPlanController::class, 'store'])->name('detail.plan.store');
        Route::get('/plans/{id}/details/create', [DetailPlanController::class, 'create'])->name('detail.plan.create');
        Route::get('/plans/{id}/details', [DetailPlanController::class, 'index'])->name('detail.plan.index');


        /**
         * route Plans
         */
        Route::put('/plans/{id}/update-photo', [PlanController::class, 'uploadFile'])->name('plans.update.image');
        Route::get('/plans/{id}/image', [PlanController::class, 'changeImage'])->name('plans.change.image');
        Route::resource('plans', PlanController::class);
        /**
         * route posts
         */
        Route::resource('posts', PostController::class);
        /**
         * route users
         */
        Route::put('/users/{id}/update-photo', [UserController::class, 'uploadFile'])->name('users.update.image');
        Route::get('/users/{id}/image', [UserController::class, 'changeImage'])->name('users.change.image');
        Route::resource('users', UserController::class);


        Route::get('/', [HomeController::class, 'index'] )->name('dashboard');


});
