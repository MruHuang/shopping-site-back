<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('excel/export','ExcelController@export');
// Route::get('excel/import','ExcelController@import');


Route::get('/', function () {
    return view('Login',['message_text'=>null]);
});

Route::group(['prefix'=>'Login'],function(){
	Route::get('/',[
		'as'=>'Login',
		'uses'=>function () {
			    return view('Login',['message_text'=>null]);
			}
	]);
	

	Route::get('LogOut',[
		'as'=>'LogOut',
		'uses'=>'LoginController@logout'
	]);
});

Route::post('LoginPost',[
	'as'=>'LoginPost',
	'uses'=>'LoginController@login'
]);

Route::group(['prefix'=>'user'],function(){
	Route::get('GetUserData/{user_type}/{message_text?}', [
		'as' => 'loginUserData',
		'uses' => 'UserManagementController@GetUserData'
	]);

	Route::post('GetUserData',[
		'as'=>'GetUserData',
		'uses'=>'UserManagementController@GetUserData'
	]);

	Route::get('UpdateUserData/{memberID}/{action_type}/{user_type}', [
		'as' => 'UpdateUserData',
		'uses' => 'UserManagementController@UpdateUserData'
	]);

	Route::post('PostUpdateUserData', [
		'as' => 'PostUpdateUserData',
		'uses' => 'UserManagementController@PostUpdateUserData'
	]);

	Route::post('UpdateUserIntegral',[
		'as'=>'UpdateUserIntegral',
		'uses'=>'UserManagementController@UpdateUserIntegral'
	]);

	Route::post('UpdateUserCancel',[
		'as'=>'UpdateUserCancel',
		'uses'=>'UserManagementController@UpdateUserCancel'
	]);

	Route::post('Search_user',[
		'as'=>'Search_user',
		'uses'=>'UserManagementController@Search_user'
	]);

	Route::post('UpdateMemberData',[
		'as'=>'UpdateMemberData',
		'uses'=>'UserManagementController@UpdateMemberData'
	]);
});

Route::group(['prefix'=>'commodity'],function(){

	Route::get('CommodityManagement/{type}/{Area}',[
		'as'=>'CommodityManagement',
		'uses'=>function($type,$Area){
			return view('CommodityManagement',[
				'message_text'=>null,
				'type'=>$type,
				'Area'=>$Area
				]);
		}
	]);

	Route::get('CommoditySpecies/{this_page?}',[
		'as'=>'CommoditySpecies',
		'uses' => 'CommodityManagementController@GetCommoditySpecies'
	]);

	Route::post('EditCommoditySpecies',[
		'as'=>'EditCommoditySpecies',
		'uses'=>'CommodityManagementController@EditCommoditySpecies'
	]);

	Route::post('AddCommoditySpecies',[
		'as'=>'AddCommoditySpecies',
		'uses'=>'CommodityManagementController@AddCommoditySpecies'
	]);

	Route::get('AddCommodity',[
		'as'=>'AddCommodity',
		'uses'=>'CommodityManagementController@AddCommodity'
	]);

	Route::post('AddingCommodity',[
		'as'=>'AddingCommodity',
		'uses'=>'CommodityManagementController@AddingCommodity'
	]);

	Route::post('ShelvesCommodity',[
		'as'=>'ShelvesCommodity',
		'uses'=>'CommodityManagementController@ShelvesCommodity'
	]);

	Route::get('GetCommodityDetail/{page_type}/{type}/{commodity_type}/{ID}',[
		'as'=>'GetCommodityDetail',
		'uses'=>'CommodityManagementController@GetCommodityDetail'
	]);

	Route::post('UpdateCommodity',[
		'as'=>'UpdateCommodity',
		'uses'=>'CommodityManagementController@UpdateCommodity'
	]);

	Route::post('unShelves',[
		'as'=>'unShelves',
		'uses'=>'CommodityManagementController@unShelves'
	]);

	Route::post('Shelves_Edit',[
		'as'=>'Shelves_Edit',
		'uses'=>'CommodityManagementController@Shelves_Edit'
	]);

	Route::get('DeleteCommodity/{page_type}/{type}/{ID?}',[
		'as'=>'DeleteCommodity',
		'uses'=>'CommodityManagementController@DeleteCommodity'
	]);

	Route::post('UpdateGroupbuydata',[
		'as'=>'UpdateGroupbuydata',
		'uses'=>'CommodityManagementController@UpdateGroupbuydata'
	]);
	
	Route::post('UpdateLimiteddata',[
		'as'=>'UpdateLimiteddata',
		'uses'=>'CommodityManagementController@UpdateLimiteddata'
	]);

	Route::get('Get/{page_type}/{type}', [
		'as' => 'commodity',
		'uses' => 'CommodityManagementController@GetCommodity'
	]);

	Route::get('Count/{page_type}/{type}', [
		'as' => 'inventory',
		'uses' => 'CommodityManagementController@GetCountCommodity'
	]);

	Route::post('Count/UpdateInventory', [
		'as' => 'UpdateInventory',
		'uses' => 'CommodityManagementController@UpdateInventory'
	]);
});

Route::group(['prefix'=>'Gift'],function(){
	Route::get('AllIntegral', [
		'as' => 'AllIntegral',
		'uses' => 'GiftManagementController@AllIntegral'
	]);

	/*Route::get('{GiftIntegral}', [
		'as' => 'GiftIntegral',
		'uses' => 'GiftManagementController@UpdateMemberIntegral'
	]);*/

	Route::post('GiftIntegral',[
		'as' => 'GiftIntegral',
		'uses' => 'GiftManagementController@UpdateMemberIntegral'
	]);

});

Route::group(['prefix'=>'Inregral'],function(){
	Route::get('GetAll', [
		'as' => 'GetAll',
		'uses' => 'IntegralManagementController@GetInregral'
	]);

	/*Route::get('{integralProportion}/{freight}/{freeFreight}', [
		'as' => 'UpdateInregral',
		'uses' => 'IntegralManagementController@UpdateIntegral'
	]);*/

	Route::post('UpdateIntegral',[
		'as'=>'UpdateIntegral',
		'uses'=>'IntegralManagementController@UpdateIntegralProportion'
	]);

	Route::post('Updatefreight',[
		'as'=>'Updatefreight',
		'uses'=>'IntegralManagementController@UpdateIntegralFreight'
	]);

	Route::post('UpdateRemittance',[
		'as'=>'UpdateRemittance',
		'uses'=>'IntegralManagementController@UpdateRemittance'
	]);

	Route::post('SendAllEmail',[
		'as'=>'SendAllEmail',
		'uses'=>'IntegralManagementController@SendAllEmail'
	]);

	Route::post('LatestNews',[
		'as'=>'LatestNews',
		'uses'=>'IntegralManagementController@LatestNews'
	]);
});

Route::group(['prefix'=>'order'],function(){
	Route::get('GetOrder/{type}/{this_page?}/{order_type?}/{message_text?}', [
		'as' => 'GetOrder',
		'uses' => 'OrderManagementController@GetOrder'
	]);

	// Route::get('UpdateOrder/{orderID}/{action_type}', [
	// 	'as' => 'UpdateOrder',
	// 	'uses' => 'OrderManagementController@UpdateOrder'
	// ]);

	Route::post('UpdateOrder',[
		'as'=>'UpdateOrder',
		'uses'=>'OrderManagementController@UpdateOrder'
	]);

	Route::post('UpdateOrderData',[
		'as'=>'UpdateOrderData',
		'uses'=>'OrderManagementController@UpdateOrderData'
	]);

	Route::get('SingleOrder/{orderID}/{orderState}/{this_page}/{order_type}',[
		'as'=>'SingleOrder',
		'uses'=>'OrderManagementController@SingleOrder'
	]);

	Route::get('MemberData/{memberID}/{orderState}/{this_page}/{order_type}',[
		'as'=>'GetMemberData',
		'uses'=>'OrderManagementController@GetMemberData'
	]);
});

Route::get('ManageManager/{type}',[
	'as'=>'ManageManager',
	'uses'=>function($type){
		return view('ManageManager',['message_text'=>null,'type'=>$type]);
	}
]);

Route::post('PostmanagerRegister',[
	'as'=>'PostmanagerRegister',
	'uses'=>'ManagerManagementController@managerRegister'
]);

Route::post('PostPrintReport',[
	'as'=>'PostPrintReport',
	'uses'=>'ExcelController@PostPrintReport'
]);