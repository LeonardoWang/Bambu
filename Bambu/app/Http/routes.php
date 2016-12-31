<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/wangyao', 'HomeController@haha');
Route::get('/login', 'HomeController@haha');
Route::get('/register','HomeController@haha2');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::post('login', 'Api\UsersController@login');
Route::get('logout','Api\UsersController@logout');
Route::post('register', 'Api\UsersController@register');

Route::group(['prefix' => 'api','middleware' => 'auth'], function () {

	//xp cannot sent DELETE request, so all destroy actions are seperatedly routed
	//also he cannot sent PUT, so update are seperatedly routed
	Route::resource('users', 'Api\UsersController', ['only' => ['index', 'show']]);
	Route::post('users/{id}', 'Api\UsersController@update');
	Route::get('users/{id}/delete', 'Api\UsersController@destroy');
	Route::get('users_information','Api\UsersController@UserInormationPage');
	
	Route::get('product','Api\ItemsController@ProductIndex');
	Route::post('product/addProduct','Api\ItemsController@ProductAdd');
	Route::get('product/show','Api\ItemsController@ProductShow');
	Route::get('product/myProduct','Api\ItemsController@MyProduct');
	
	Route::resource('items', 'Api\ItemsController', ['only' => ['index', 'store', 'show']]);
	Route::post('items/{id}', 'Api\ItemsController@update');
	Route::get('items/{id}/delete', 'Api\ItemsController@destroy');
	Route::get('items/{id}/images', 'Api\ItemsController@images');
	Route::get('items/search/{keyword}', 'Api\ItemsController@search');

	Route::resource('trade_requests', 'Api\TradeRequestsController', ['only' => ['index', 'store', 'show']]);
	Route::post('trade_requests/{id}', 'Api\TradeRequestsController@update');
	Route::get('trade_requests/{id}/delete', 'Api\TradeRequestsController@destroy');

	Route::get('chat_room','Api\ChatController@Chatroom');
	Route::get('chat_room/MyChatroom','Api\ChatController@MyChatroom');
	Route::get('chat_room/{item_id}','Api\ChatController@ChatRoomIndex');

	Route::post('chat','Api\ChatController@Chat');


	Route::group(['prefix' => 'users/{user_id}'], function()
	{
        Route::get('favorites', 'Api\FavoritesController@index');
        Route::post('favorites', 'Api\FavoritesController@store');
        Route::get('favorites/{item_id}/delete', 'Api\FavoritesController@destroy');

		Route::get('items', 'Api\UsersController@getItems');
		Route::get('trade_requests/sent', 'Api\UsersController@getSentRequests');
		Route::get('trade_requests/received', 'Api\UsersController@getReceivedRequests');
	});

	Route::post('images', 'Api\ImagesController@store');
	Route::get('product/images/{image_file}', 'Api\ImagesController@show');
	Route::get('images/{image_file}/delete', 'Api\ImagesController@destroy');
});
