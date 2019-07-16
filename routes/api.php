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
    'rfq' => 'API\RfqController',
]);

Route::post('receive_dmd', 'API\PurchaseOrderController@receive_dmd');

Route::get('dmd_rfq/{id}', 'API\RfqController@dmd_rfq');
Route::get('dmd_aoq/{id}/{rfq_id}', 'API\RfqController@dmd_aoq');

Route::post('rfq_to_po', 'API\PurchaseRequestController@rfq_to_po');

Route::get('mds_consignment', 'API\MdsConsignmentController@index');
Route::get('add_to_mds_cart/{cl2comb}/{costprc}', 'API\MdsConsignmentCartController@store');
Route::get('mds_cart', 'API\MdsConsignmentCartController@index');
Route::post('mds_c_pr_submit', 'API\MdsConsignmentCartController@submit_cart');
Route::get('cpr/{id}', 'API\ConsignmentRequestController@show');
Route::get('cprs', 'API\ConsignmentRequestController@index');

Route::put('terminate/{id}', 'API\DmdPurchaseRequestController@terminate');
Route::put('receive/{id}', 'API\DmdPurchaseRequestController@receive');
Route::put('terminate_po/{id}', 'API\PurchaseOrderController@terminate_po');

Route::get("for_mmo", 'API\DrugsAndMedicineController@for_mmo');
Route::post("beg_bal", 'API\DrugsAndMedicineController@beg_bal');
Route::get("terminated", 'API\DrugsAndMedicineController@terminated');


Route::get('need_to_receive', 'API\DrugsAndMedicineController@need_to_receive');
Route::get('pmo_pr', 'API\PurchaseRequestController@for_pmo');
Route::get('new_pmo_pr', 'API\PurchaseRequestController@new_for_pmo');

Route::post('store_po', 'API\PurchaseOrderController@store');

Route::put('approved_pr/{id}', 'API\PurchaseRequestController@approved');
Route::post('pr_remarks', 'API\PurchaseRequestRemarksController@store');
Route::post('dmd_remarks', 'API\DmdRemarksController@store');
Route::put('send_to_cmps/{id}', 'API\PurchaseRequestController@send_to_cmps');
Route::post('date_of_delivery', 'API\PurchaseOrderController@store_date_of_delivery');
Route::get('new_purchase_request', 'API\PurchaseRequestController@new');
Route::get('consignment/{id}', 'API\ConsignmentController@search');

Route::post('received_dmd', 'API\PurchaseOrderController@received_dmd');

Route::post('add_rfq/{id}', 'API\RfqController@add_rfq');
Route::get('pr_shopping', 'API\PurchaseRequestController@shopping');
Route::get('pr_public_bidding', 'API\PurchaseRequestController@public_bidding');
Route::post('pr_submit', 'API\PurchaseRequestController@pr_submit');
Route::get('pr_items', 'API\CartController@pr_items');
Route::get('shopping', 'API\CartController@shopping');
Route::post('shopping', 'API\DmdPurchaseRequestController@shopping');
Route::post('obrs', 'API\PurchaseOrderController@store_update_obrs');
Route::put('div_head_rcv/{id}', 'API\PurchaseRequestController@div_head_rcv');
Route::put('div_head_rls/{id}', 'API\PurchaseRequestController@div_head_rls');
Route::put('pmo_rcv/{id}', 'API\PurchaseRequestController@pmo_rcv');
Route::put('pmo_rls/{id}', 'API\PurchaseRequestController@pmo_rls');

Route::put('div_head_rcv_2/{id}', 'API\PurchaseOrderController@div_head_rcv_2');
Route::put('div_head_rls_2/{id}', 'API\PurchaseOrderController@div_head_rls_2');
Route::put('pmo_rcv_2/{id}', 'API\PurchaseOrderController@pmo_rcv_2');
Route::put('pmo_rls_2/{id}', 'API\PurchaseOrderController@pmo_rls_2');
Route::put('budget_rcv/{id}', 'API\PurchaseOrderController@budget_rcv');
Route::put('budget_rls/{id}', 'API\PurchaseOrderController@budget_rls');
Route::put('accounting_rcv/{id}', 'API\PurchaseOrderController@accounting_rcv');
Route::put('accounting_rls/{id}', 'API\PurchaseOrderController@accounting_rls');

Route::put('mcc_rcv/{id}', 'API\PurchaseOrderController@mcc_rcv');
Route::put('mcc_rls/{id}', 'API\PurchaseOrderController@mcc_rls');
Route::put('fmo_rcv/{id}', 'API\PurchaseOrderController@fmo_rcv');
Route::put('fmo_rls/{id}', 'API\PurchaseOrderController@fmo_rls');
Route::put('pmo_rcv_3/{id}', 'API\PurchaseOrderController@pmo_rcv_3');
Route::put('pmo_rls_3/{id}', 'API\PurchaseOrderController@pmo_rls_3');
Route::put('pmo_rcv_3/{id}', 'API\PurchaseOrderController@pmo_rcv_3');
Route::put('pmo_rls_3/{id}', 'API\PurchaseOrderController@pmo_rls_3');
Route::put('mmo_rcv/{id}', 'API\PurchaseOrderController@mmo_rcv');
Route::put('mmo_rls/{id}', 'API\PurchaseOrderController@mmo_rls');

Route::get('public_bidding', 'API\CartController@public_bidding');
Route::post('dmd_uacs', 'API\DmdUacsController@store');
Route::put('dmd_uacs/{id}', 'API\DmdUacsController@update');
Route::post('cart_dmd/{user_id}', 'API\CartController@add_dmd');
Route::post('cart_dmd_2/{user_id}', 'API\CartController@add_dmd_2');
Route::post('cart_dmd_3/{user_id}', 'API\CartController@add_p_3');
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
