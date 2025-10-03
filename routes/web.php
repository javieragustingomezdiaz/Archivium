<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserRoleController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

Route::get('/admin', fn() => 'Admin.panel')
    ->middleware('role:Admin');

Route::middleware(['auth', 'role:Admin'])->prefix('admin')
    ->name('admin')->group(function(){
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::get('user/{user}/roles', [UserRoleController::class, 'edit'])->name('users.roles.edit');
        Route::put('users/{user}/roles', [UserRoleController::class, 'update'])->name('users.roles.update');
    });

require __DIR__.'/auth.php';
