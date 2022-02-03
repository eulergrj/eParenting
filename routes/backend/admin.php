<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ViewHistoryController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\Frontend\User\ProfileController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);

Route::any('dashboard', [DashboardController::class, 'index'])
->name('dashboard')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'));
});

Route::any('viewHistory', [ViewHistoryController::class, 'index'])
->name('viewHistory')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'));
    $trail->push(__('View History'), route('admin.viewHistory'));
});

Route::any('familyMembers', [FamilyMemberController::class, 'index'])
->name('familyMembers')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'));
    $trail->push(__('Family Members'), route('admin.familyMembers'));
});


// COUNTRIES
Route::get('countries', [CountryController::class, 'index'])
->name('countries')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'));
    $trail->push(__('Countries'));
});
Route::get('countries/nedit/{id?}', [CountryController::class, 'nedit'])
->name('countries.nedit')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'));
    $trail->push(__('Countries'), route('admin.countries'));
    $trail->push(__('Create/Edit'));
});
Route::post('countries/upsert', [CountryController::class, 'upsert'])->name('countries.upsert');
Route::get('countries/remove/{id}', [CountryController::class, 'remove'])->name('countries.remove');
