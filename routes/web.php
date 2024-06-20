<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Redirect::route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/user/permission', PermissionController::class)->except(['create', 'show']);
    Route::resource('/user/role', RoleController::class)->except(['create']);
    Route::post('/user/role/permission/{role}',
        [RoleController::class, 'togglePermission'])->name('role.permission.store');
    Route::delete('/user/role/{role}/{permission}',
        [RoleController::class, 'detachPermission'])->name('role.permission.destroy');
    Route::resource('/user', UserController::class);
    Route::resource('/campaign', CampaignController::class)->except('destroy');
    Route::get('/campaign/{campaign}/download', [CampaignController::class, 'download'])->name('campaign.download');
    Route::get('/campaign/{campaign}/download_report',
        [CampaignController::class, 'download_report'])->name('campaign.download_report');
    Route::get('/campaign/{campaign}/download_numbers',
        [CampaignController::class, 'download_numbers'])->name('campaign.download_numbers');
    Route::get('/download_csv/{path}', [CampaignController::class, 'download_csv'])->name('download_csv');
    Route::get('/download_csv/{path}/{path1?}', [CampaignController::class, 'download_csv']);
    Route::resource('/credit', CreditController::class)->only(['index', 'show', 'update']);
});

require __DIR__ . '/auth.php';
