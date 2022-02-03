<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [UserController::class, 'login'])->name('api.login');
Route::post('register', [UserController::class, 'register'])->name('api.register');

Route::group(['middleware' => 'auth:api'], function(){
    // Users    
    Route::post('getUser', [UserController::class, 'details'])->name('api.users.details');    
    Route::post('getUserByUuid', [UserController::class, 'getUserByUuid'])->name('api.users.getUserByUuid');        
    Route::post('updateProfile', [UserController::class, 'updateProfile'])->name('api.users.updateProfile');        
    Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('api.users.updatePassword');
    Route::get('getPatientCategories', [UserController::class, 'getPatientCategories'])->name('api.users.getPatientCategories');
    Route::post('getPatients', [UserController::class, 'getPatients'])->name('api.users.getPatients');
    Route::post('addPatient', [UserController::class, 'addPatient'])->name('api.users.addPatient');
    Route::post('getUserInfo', [UserController::class, 'getUserInfo'])->name('api.users.getUserInfo');
    Route::post('getAddresses', [UserController::class, 'getAddresses'])->name('api.users.getAddresses');
    Route::post('getAddressesFormData', [UserController::class, 'getAddressesFormData'])->name('api.users.getAddressesFormData');
    Route::post('saveAddress', [UserController::class, 'saveAddress'])->name('api.users.saveAddress');

    Route::post('getPaymentMethods', [UserController::class, 'getPaymentMethods'])->name('api.users.getPaymentMethods');
    Route::post('createPaymentMethod', [UserController::class, 'createPaymentMethod'])->name('api.users.createPaymentMethod');
    Route::post('removePaymentMethod', [UserController::class, 'removePaymentMethod'])->name('api.users.removePaymentMethod');
    Route::post('getOrders', [UserController::class, 'getOrders'])->name('api.users.getOrders');
    Route::post('createOrder', [UserController::class, 'createOrder'])->name('api.users.createOrder');

    Route::post('applyCartDiscounts', [UserController::class, 'applyCartDiscounts'])->name('api.users.applyCartDiscounts');
    Route::post('pay', [UserController::class, 'pay'])->name('api.users.pay');


    // Products
    Route::post('getProducts', [ApiController::class, 'list'])->name('api.products.list');    
});