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
Route::get('/home', 'HomeController@index');
Route::get('/test', 'HomeController@test');

Route::get('/register','HomeController@register');
Route::get('/smscode','HomeController@sendSMS');

Route::get('/login', 'HomeController@login');
Route::get('/test',"HomeController@test");

Route::get('/notifEvent', function(){
    Event::fire(new \App\Events\NotifEvent(1));
    return "hello world";
});

Route::get('/event', function(){
    Event::fire(new \App\Events\SomeEvent(2,1,"22132132"));
    return "hello world";
});

Route::get('/user_name/{id}','HomeController@userName');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::post('login', 'Api\UsersController@login');
Route::get('logout','Api\UsersController@logout');
Route::post('register', 'Api\UsersController@register');
Route::get('api/product/images/{image_file}', 'Api\ImagesController@show');
Route::get('items/KSearch/{keyword}', 'Api\ItemsController@KSearch');
Route::get('items/CSearch/{category}/{keyword?}', 'Api\ItemsController@CSearch');
Route::group(['prefix' => 'api','middleware' => 'auth'], function () {

	//xp cannot sent DELETE request, so all destroy actions are seperatedly routed
	//also he cannot sent PUT, so update are seperatedly routed
	Route::resource('users', 'Api\UsersController', ['only' => ['index', 'show']]);

	Route::post('users/{id}', 'Api\UsersController@userInformationUpdate');
	Route::get('users/{id}/delete', 'Api\UsersController@destroy');
	Route::post('userImage/{id}', 'Api\UsersController@userImageUpdate');
	Route::get('users_information','Api\UsersController@userInformationPage');
	Route::get('user/{id}/info', 'Api\UsersController@otherUserInformationPage');
	
	Route::get('product','Api\ItemsController@ProductIndex');
	Route::post('product/addProduct','Api\ItemsController@ProductAdd');
	Route::get('product/show','Api\ItemsController@ProductShow');
	Route::get('product/myProduct','Api\ItemsController@MyProduct');
	
	Route::resource('items', 'Api\ItemsController', ['only' => ['index', 'store', 'show']]);
	Route::post('items/{id}', 'Api\ItemsController@update');
	Route::get('items/{id}/delete', 'Api\ItemsController@destroy');
	Route::get('items/{id}/images', 'Api\ItemsController@images');
	
	Route::get('trade_requests/my','Api\TradeRequestsController@myRequest');
	Route::get('trage_requests/delete/{id}','Api\TradeRequestsController@destroy');
	Route::get('trade_requests/{id}','Api\TradeRequestsController@doRequest');
	
	Route::post('trade_request_making','Api\TradeRequestsController@postRequest');
	//Route::resource('trade_requests', 'Api\TradeRequestsController', ['only' => ['index', 'store', 'show']]);
	
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	//Route::post('trade_requests/{id}', 'Api\TradeRequestsController@update');
	//Route::get('trade_requests/doRequest', 'Api\TradeRequestsController@doRequest');
	
	//Route::get('trade_requests/{id}/delete', 'Api\TradeRequestsController@destroy');

	Route::get('chat_room','Api\ChatController@Chatroom');
	Route::get('chat_room/MyChatroom','Api\ChatController@MyChatroom');
	
	Route::get('chat_room/MyNotif','Api\ChatController@MyNotif');

	Route::get('chat','Api\ChatController@Chat');
	Route::get('chat/GetChatMessageByUserId','Api\ChatController@GetChatMessageByUserId');
	Route::get('chat/GetChatMessageByChatRoomID','Api\ChatController@GetChatMessageByChatRoomID');
	Route::get('chat/GetChatRoomIDByUserID','Api\ChatController@GetChatRoomIDByUserID');

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
	
	Route::get('images/{image_file}/delete', 'Api\ImagesController@destroy');
});
