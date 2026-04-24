<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequiredApprovalController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');


Route::middleware(['auth', 'language'])->group(function () {
    

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users.index');
        Route::post('users', 'store');
        Route::put('users/{user}', 'update');
        Route::get('users/locale', 'updateLocale')->name('users.updateLocale');
        Route::delete('users/{user}', 'destroy');
        Route::post('users/upload', 'upload');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('roles', 'index')->name('roles.index');
        Route::post('roles', 'store');
        Route::put('roles/{role}', 'update');
        Route::delete('roles/{role}', 'destroy');
    });

    Route::controller(PermissionController::class)->group(function () {
        Route::get('permissions', 'index')->name('permissions.index');
        Route::post('permissions', 'store');
        Route::put('permissions/{permission}', 'update');
        Route::delete('permissions/{permission}', 'destroy');
    });

    Route::controller(CompanyController::class)->group(function () {
        Route::get('companies', 'index')->name('companies.index');
        Route::post('companies', 'store');
        Route::put('companies/{company}', 'update');
        Route::delete('companies/{company}', 'destroy');
    });

    Route::controller(DocumentController::class)->group(function () {
        Route::get('documents', 'index')->name('documents.index');
        Route::post('documents', 'store');
        Route::put('documents/{document}', 'update');
        Route::delete('documents/{document}', 'destroy');
    });

    Route::controller(RequiredApprovalController::class)->group(function () {
        Route::get('required-approvals', 'index')->name('required-approvals.index');
        Route::post('required-approvals', 'store');
        Route::put('required-approvals/{requiredApproval}', 'update');
        Route::delete('required-approvals/{requiredApproval}', 'destroy');
    });

    Route::controller(EquipmentController::class)->group(function () {
        Route::get('equipment', 'index')->name('equipment.index');
        Route::post('equipment', 'store');
        Route::put('equipment/{equipment}', 'update');
        Route::delete('equipment/{equipment}', 'destroy');
    });

    // settings
    Route::controller(SettingController::class)->group(function () {
        Route::get('project-settings', 'edit')->name('project-settings.edit');
        Route::put('project-settings', 'update');
    });

    // attachments
    Route::controller(AttachmentController::class)->group(function () {
        Route::get('update-attachments-path', 'updatePath');
        Route::get('attachments', 'index')->name('attachments.index');
        Route::post('attachments', 'store');
        Route::put('attachments/{attachment}', 'update');
        Route::delete('attachments/{attachment}', 'destroy');
        Route::get('attachments/{encrypted_id}', 'view')->name('attachments.view');
    });

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
