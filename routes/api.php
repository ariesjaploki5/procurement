<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResources([
    'app' => 'API\AppController',

    'brand' => 'API\BrandController',

    'category' => 'API\CategoryController',
    
    'country' => 'API\CountryController',
    
    'end_user' => 'API\EndUserController',

    'item' => 'API\ItemController',
    
    'mode' => 'API\ModeController',
    
    'packaging' => 'API\PackagingController',

    'ppmp' => 'API\PpmpController',

    'price_schedule' => 'API\PriceScheduleController',

    'purchase_order' => 'API\PurchaseOrderController',

    'purchase_request' => 'API\PurchaseRequestController',

    'supplier' => 'API\SupplierController',
]);