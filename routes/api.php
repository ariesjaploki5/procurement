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
    'manufacturer' => 'API\ManufacturerController',
    'item_price_schedule' => 'API\ItemPriceScheduleController',
]);

Route::post('item_price_schedule/{id}', 'API\ItemPriceScheduleController@store');
Route::put('item_price_schedule/{id}/terminate', 'API\ItemPriceScheduleController@terminate');
Route::put('item_price_schedule/{id}/unterminate', 'API\ItemPriceScheduleController@unterminate');

Route::get('price_schedule_get/{id}', 'API\PriceScheduleController@price_schedule_get');

Route::get('inventory/{id}', 'API\InventoryController@index');

Route::get('get_ppmp/{id}', 'API\PpmpController@get_ppmp');
Route::get('ppmp_get/{id}', 'API\PpmpController@ppmp_get');

Route::get('ppmp_show2/{ppmp_id}/{category_id}', 'API\PpmpController@show2');

Route::get('category_app/{id}', 'API\CategoryController@app');

Route::post('search_item/{id}', 'API\ItemController@search');
Route::post('search_item_ppmp/{id}', 'API\ItemController@search_item_ppmp');

Route::post('item_ppmp/{ppmp_id}/{item_id}', 'API\ItemPpmpController@store');
Route::get('item_ppmp/{id}', 'API\ItemPpmpController@show');