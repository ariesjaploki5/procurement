<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::apiResources([

    'allotment' => 'API\AllotmentController',
    'app' => 'API\AppController',
    'app_dmd' => 'API\AppDmdController',

    'brand' => 'API\BrandController',

    'cart'=> 'API\CartController',
    'category' => 'API\CategoryController',
    'country' => 'API\CountryController',

    'dmd' => 'API\DrugsAndMedicineController',
    'dmd_pr' => 'API\DmdPurchaseRequestController',
    'dmd_price_schedule' => 'API\DmdPriceScheduleController',

    'end_user' => 'API\EndUserController',

    

    'item' => 'API\ItemController',
    'item_price_schedule' => 'API\ItemPriceScheduleController',

    'manufacturer' => 'API\ManufacturerController',
    'mode' => 'API\ModeController',

    'notice_of_adjustment' => 'API\NoticeOfAdjustmentController',

    'packaging' => 'API\PackagingController',
    'payment_term' => 'API\PaymentTermController',
    'ppmp' => 'API\PpmpController',
    'price_schedule' => 'API\PriceScheduleController',
    'purchase_order' => 'API\PurchaseOrderController',
    'purchase_request' => 'API\PurchaseRequestController',

    'rfq' => 'API\RfqController',

    'supplier' => 'API\SupplierController',
    
    'uacs' => 'API\UacsController',
    'uacs_code' => 'API\UacsCodeController', 
    'unit' => 'API\UnitController',
    'user' => 'API\UserController',
    'fund_source_code' => 'API\FundSourceCodeController',
    'fund_cluster' => 'API\FundClusterController',
    'fund_source' => 'API\FundSourceController',

    'holiday' => 'API\HolidayController',
    
]);

Route::post('dmd_unit', 'API\DrugsAndMedicineController@update_unit');

Route::post('release', 'API\PurchaseOrderController@release');

Route::get('get_needed_code', 'API\DmdUacsController@get_needed_code');

Route::put('change_po', 'API\DmdPurchaseOrderController@change_po');
Route::put('update_order', 'API\DmdPurchaseOrderController@update_order');

Route::get('purchase_request_track/{id}', 'API\TrackController@show');

Route::get('get_all_iar', 'API\IarController@index');

Route::post('iar', 'API\IarController@store');
Route::get('iar_batch/{id}', 'API\IarBatchController@show');
Route::get('iar_batch_2/{id}', 'API\IarBatchController@show_4');
Route::get('iar_batch_3/{id}', 'API\IarBatchController@show_2');

Route::get('get_iar/{id}', 'API\IarBatchController@get_iar');

Route::post('dv', 'API\DvController@store');
Route::get('dv', 'API\DvController@index');

Route::post('attachment', 'API\DvAttachmentController@store');

Route::get('attachment', 'API\AttachmentController@index');
Route::get('approving_officer', 'API\AttachmentController@approving_officer');
Route::get('get_dv_item/{id}', 'API\PurchaseOrderController@get_dv_item');

Route::get('get_liquidated_damages/{id}', 'API\PurchaseOrderController@get_liquidated_damages');
Route::get('get_attachments/{id}', 'API\PurchaseOrderController@get_attachments');

Route::get('receiving_officer', 'API\ReceivingOfficerController@index');
Route::get('inspector', 'API\InspectorController@index');

Route::post('dmd_po_receive', 'API\DmdPoReceivedController@store');
Route::put('dmd_po_receive/{id}', 'API\DmdPoReceivedController@update');

Route::get('mmo_dmd_po', 'API\PurchaseOrderController@mmo_dmd_po');
Route::post('mmo_dmd_po_search', 'API\PurchaseOrderController@mmo_dmd_po_search');

Route::get('purchase_order_obrs/{id}', 'API\PurchaseOrderController@purchase_order_obrs');
Route::get('po_show/{id}', 'API\PurchaseOrderController@po_show');

Route::get('budget_show/{id}', 'API\PurchaseOrderController@budget_show');

Route::post('search_pr', 'API\PurchaseRequestController@search_pr');
Route::post('search_po', 'API\PurchaseOrderController@search_po');

Route::post('search_for_mmo', 'API\PurchaseOrderController@search_for_mmo');

Route::get('all_dmd_pr', 'API\PurchaseRequestController@dmd_pr');
Route::get('pr_for_cmps', 'API\PurchaseRequestController@for_cmps');
Route::get('pr_for_pmo', 'API\PurchaseRequestController@for_pmo');

Route::get('po_for_pmo', 'API\PurchaseOrderController@for_pmo');
Route::get('po_for_budget', 'API\PurchaseOrderController@for_budget');
Route::get('po_for_cmps', 'API\PurchaseOrderController@for_cmps');

Route::get('for_mmo_po', 'API\PurchaseOrderController@for_mmo');
Route::get('for_mcc', 'API\PurchaseOrderController@for_mcc');
Route::get('for_fmo', 'API\PurchaseOrderController@for_fmo');
Route::get('for_accounting', 'API\PurchaseOrderController@for_accounting');
Route::get('for_budget', 'API\PurchaseOrderController@for_budget');

Route::get('get_po/{id}', 'API\PurchaseOrderController@get_po');
Route::get('get_pr/{id}', 'API\PurchaseRequestController@get_pr');

Route::get('get_pr_total_amount/{id}', 'API\PurchaseRequestController@get_total_amount');

Route::post('received_po_dmd', 'API\DmdReceivedController@store');
Route::put('notice_to_terminate/{id}', 'API\PurchaseOrderController@notice_to_terminate');
Route::post('rfq_to_po', 'API\PurchaseRequestController@rfq_to_po');
Route::get('pr_dmd_rqf/{id}', 'API\RfqController@show');
Route::post('pr_to_po', 'API\PurchaseRequestController@pr_to_po');
Route::put('change_patient/{id}/{hpercode}','API\ConsignmentRequestController@change_patient');
Route::get('need_to_pr', 'API\DrugsAndMedicineController@need_to_pr');
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
Route::put('unterminate_po/{id}', 'API\PurchaseOrderController@unterminate_po');
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
Route::post('dod', 'API\PurchaseOrderController@store_dod');
Route::post('pod', 'API\PurchaseOrderController@store_pod');
Route::get('new_purchase_request', 'API\PurchaseRequestController@new');
Route::get('consignment/{id}', 'API\ConsignmentController@search');
Route::post('received_dmd', 'API\PurchaseOrderController@received_dmd');

Route::post('search_patient', 'API\MdsConsignmentCartController@search_patient');
Route::post('select_enccode', 'API\MdsConsignmentCartController@select_enccode');

Route::post('add_rfq/{id}', 'API\RfqController@add_rfq');
Route::get('pr_shopping', 'API\PurchaseRequestController@shopping');

Route::get('pr_public_bidding', 'API\PurchaseRequestController@public_bidding');
Route::post('pr_submit', 'API\PurchaseRequestController@pr_submit');

Route::get('pr_items', 'API\CartController@pr_items');
Route::get('shopping', 'API\CartController@shopping');

Route::post('shopping', 'API\DmdPurchaseRequestController@shopping');
Route::post('obrs', 'API\PurchaseOrderController@store_update_obrs');

Route::put('cmps_rcv/{id}', 'API\PurchaseRequestController@cmps_rcv');
Route::put('cmps_rls/{id}', 'API\PurchaseRequestController@cmps_rls');

Route::put('pmo_rcv/{id}', 'API\PurchaseRequestController@pmo_rcv');
Route::put('pmo_rls/{id}', 'API\PurchaseRequestController@pmo_rls');


Route::put('cmps_rcv_po/{id}', 'API\PurchaseOrderController@cmps_rcv_po');
Route::put('cmps_rls_po/{id}', 'API\PurchaseOrderController@cmps_rls_po');
Route::put('cmps_rtn_po/{id}', 'API\PurchaseOrderController@cmps_rtn_po');

Route::put('pmo_rtn_po/{id}', 'API\PurchaseOrderController@pmo_rtn_po');
Route::put('pmo_rls_po/{id}', 'API\PurchaseOrderController@pmo_rls_po');

Route::put('pmo_rcv_po_2/{id}', 'API\PurchaseOrderController@pmo_rcv_po_2');
Route::put('pmo_rls_po_2/{id}', 'API\PurchaseOrderController@pmo_rls_po_2');

Route::put('pmo_to_mmo/{id}', 'API\PurchaseOrderController@pmo_to_mmo');

Route::put('budget_rcv/{id}', 'API\PurchaseOrderController@budget_rcv');
Route::put('budget_rls/{id}', 'API\PurchaseOrderController@budget_rls');
Route::put('budget_rtn/{id}', 'API\PurchaseOrderCOntroller@budget_rtn');

Route::put('accounting_rcv/{id}', 'API\PurchaseOrderController@accounting_rcv');
Route::put('accounting_rls/{id}', 'API\PurchaseOrderController@accounting_rls');
Route::put('accounting_rtn/{id}', 'API\PurchaseOrderController@accounting_rtn');

Route::put('mcc_rcv/{id}', 'API\PurchaseOrderController@mcc_rcv');
Route::put('mcc_rls/{id}', 'API\PurchaseOrderController@mcc_rls');
Route::put('mcc_rtn/{id}', 'API\PurchaseOrderController@mcc_rtn');

Route::put('fmo_rcv/{id}', 'API\PurchaseOrderController@fmo_rcv');
Route::put('fmo_rls/{id}', 'API\PurchaseOrderController@fmo_rls');
Route::put('fmo_rtn/{id}', 'API\PurchaseOrderController@fmo_rtn');

Route::put('mmo_rcv/{id}', 'API\PurchaseOrderController@mmo_rcv');
Route::put('mmo_rls/{id}', 'API\PurchaseOrderController@mmo_rls');
Route::put('mmo_rtn/{id}', 'API\PurchaseOrderController@mmo_rtn');

Route::get('dmd_uacs_2', 'API\DrugsAndMedicineController@dmd_uacs_2');
Route::get('dmd_uacs', 'API\DmdUacsController@index');
Route::get('public_bidding', 'API\CartController@public_bidding');

Route::post('dmd_uacs', 'API\DmdUacsController@store');

Route::put('dmd_uacs/{id}', 'API\DmdUacsController@update');

Route::post('search_dmd_uacs', 'API\DmdUacsController@search');
Route::post('cart_dmd/{user_id}', 'API\CartController@add_dmd');
Route::post('cart_dmd_2/{user_id}', 'API\CartController@add_dmd_2');
Route::post('cart_dmd_3/{user_id}', 'API\CartController@add_p_3');

Route::delete('cart_dmd/{id}', 'API\CartController@remove_dmd');

Route::get('cmps_dmd', 'API\DrugsAndMedicineController@cmps_dmd');

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

