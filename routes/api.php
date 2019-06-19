<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::apiResources([
    'uacs' => 'API\UacsController',
    'fund_source' => 'API\FundSourceController',
    'uacs_code' => 'API\UacsCodeController', 
    'allotment' => 'API\AllotmentController',
    'app' => 'API\AppController',
    'unit' => 'API\UnitController',
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
    'dmd_price_schedule' => 'API\DmdPriceScheduleController',
    'app_dmd' => 'API\AppDmdController',
    'user' => 'API\UserController',
    'dmd' => 'API\DrugsAndMedicineController',
    'dmd_pr' => 'API\DmdPurchaseRequestController',
    'cart'=> 'API\CartController',
]);

Route::get('shopping', 'API\CartController@shopping');
Route::post('shopping', 'API\DmdPurchaseRequestController@shopping');


Route::post('obrs', 'API\PurchaseOrderController@store_update_obrs');

Route::put('div_head_rcv/{id}', 'API\PurchaseRequestController@div_head_rcv');
Route::put('div_head_rls/{id}', 'API\PurchaseRequestController@div_head_rls');
Route::put('pmo_rcv/{id}', 'API\PurchaseRequestController@pmo_rcv');
Route::put('pmo_rls/{id}', 'API\PurchaseRequestController@pmo_rls');
Route::put('div_head_rcv_2/{id}', 'API\PurchaseRequestController@div_head_rcv_2');
Route::put('div_head_rls_2/{id}', 'API\PurchaseRequestController@div_head_rls_2');
Route::put('pmo_rcv_2/{id}', 'API\PurchaseRequestController@pmo_rcv_2');
Route::put('pmo_rls_2/{id}', 'API\PurchaseRequestController@pmo_rls_2');
Route::put('budget_rcv/{id}', 'API\PurchaseRequestController@budget_rcv');
Route::put('budget_rls/{id}', 'API\PurchaseRequestController@budget_rls');
Route::put('accounting_rcv/{id}', 'API\PurchaseRequestController@accounting_rcv');
Route::put('accounting_rls/{id}', 'API\PurchaseRequestController@accounting_rls');
Route::put('mcc_rcv/{id}', 'API\PurchaseRequestController@mcc_rcv');
Route::put('mcc_rls/{id}', 'API\PurchaseRequestController@mcc_rls');
Route::put('fmo_rcv/{id}', 'API\PurchaseRequestController@fmo_rcv');
Route::put('fmo_rls/{id}', 'API\PurchaseRequestController@fmo_rls');
Route::put('pmo_rcv_3/{id}', 'API\PurchaseRequestController@pmo_rcv_3');
Route::put('pmo_rls_3/{id}', 'API\PurchaseRequestController@pmo_rls_3');
Route::put('pmo_rcv_3/{id}', 'API\PurchaseRequestController@pmo_rcv_3');
Route::put('pmo_rls_3/{id}', 'API\PurchaseRequestController@pmo_rls_3');
Route::put('mmo_rcv/{id}', 'API\PurchaseRequestController@mmo_rcv');
Route::put('mmo_rls/{id}', 'API\PurchaseRequestController@mmo_rls');

Route::get('public_bidding', 'API\CartController@public_bidding');


Route::post('dmd_uacs', 'API\DmdUacsController@store');
Route::put('dmd_uacs/{id}', 'API\DmdUacsController@update');

Route::post('cart_dmd/{user_id}', 'API\CartController@add_dmd');
Route::post('cart_dmd_2/{user_id}', 'API\CartController@add_dmd_2');
Route::delete('cart_dmd/{id}', 'API\CartController@remove_dmd');

Route::post('dmd_search', 'API\DrugsAndMedicineController@search');
Route::put('dmd_ssl_update/{id}', 'API\DrugsAndMedicineController@update_ssl');
Route::get('dmd_mode/{id}', 'API\DrugsAndMedicineController@dmd_pr');

Route::post('dmd_price_schedule/{id}', 'API\DmdPriceScheduleController@store');
Route::put('dmd_price_schedule/{id}/terminate', 'API\DmdPriceScheduleController@terminate');
Route::put('dmd_price_schedule/{id}/unterminate', 'API\DmdPriceScheduleController@unterminate');

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
Route::put('item_ppmp/{id}', 'API\ItemPpmpController@update');

Route::get('item_links', 'API\LinkController@index');
Route::get('homis_drugs_and_medicines', 'API\LinkController@homis_drugs_and_medicines');
Route::put('item_homis_link', 'API\LinkController@item_homis_link');


Route::get('homis_end_user', 'API\HomisEndUserController@index');
Route::get('adjustment/{id}', 'API\AdjustmentController@items');
Route::post('adjustment/{id}', 'API\AdjustmentController@search');

Route::get('get_medicines', 'API\AdjustmentController@get_medicines');
Route::post('add_medicine/{id}', 'API\AdjustmentController@add_medicine');
Route::post('adjust_medicine', 'API\AdjustmentController@adjust_medicine');
