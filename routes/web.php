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

Auth::routes();



/** Admin panel **/
Route::middleware('isAdmin')->prefix('admin')->group(function (){
    Route::get('/',function (){
        return view('admin');
    });
    // User stuff, only get/delete
    Route::get('users','GetController@getUsers'); //Get user info
    Route::put('users','UpdateElementController@updateUser'); //Change username
    Route::delete('users','CleanController@deleteUser'); //Not done

    //Roles stuff
    Route::post('roles','UpdateElementController@createRole'); //Create role
    Route::get('roles','GetController@getRoles'); //Get all roles
    Route::put('roles','UpdateElementController@updateRole'); //Edit role
    Route::delete('roles','CleanController@deleteRole'); //Delete role

    Route::get('roles/user',"GetController@getUserRoles"); //Get user roles (used)
    Route::delete('roles/user',"CleanController@deleteRoleFromUser"); //Delete role from user
    Route::post('roles/user',"UpdateElementController@addRoleToUser"); //Assign role to user

    Route::get('roles/user/free',"GetController@getUserNotAssignedRoles"); //Get user roles (unused)


    //Categories stuff
    Route::get('categories','GetController@getCategories'); //Get all categories
    Route::get('categories/details','GetController@categoryDetails');
    Route::post('categories','ThreadController@createCategory'); //Create category
    Route::put('categories','UpdateElementController@updateCategory'); //Edit category
    Route::delete('categories','CleanController@deleteCategory'); //Delete category and it's channels, threads and posts


    //Channels stuff
    Route::get('channels','GetController@getChannels'); //Get channels of determined category
    Route::post('channels','ThreadController@createChannel'); //Create channel in determined category
    Route::delete('channels','CleanController@deleteChannel'); //Delete channel from category


    //Items stuff
    Route::get('items','ItemController@getItems'); //Get items (in page)

    Route::get('items/all','ItemController@getAllItems'); //Get all items

    Route::get('items/user','ItemController@getUserItems'); //Get items of a user
    Route::post('items/user','ItemController@itemToUser'); //Give item to user
    Route::delete('items/user','ItemController@takeItemFromUser'); //Delete item from user

    Route::put('items','ItemController@editItem'); //Edit item
    Route::post('items','ItemController@createItem'); //Create item
    Route::delete('items','ItemController@deleteItem'); //Delete item


    //Vendors stuff
    Route::get('vendors','VendorController@getVendors'); //Get vendors (in pages)
    Route::get('vendors/all','VendorController@getPossibleVendors');
    Route::post('vendors','VendorController@createVendor'); //Create a vendor
    Route::put('vendors','VendorController@editVendor'); //Edit a vendor
    Route::delete('vendors','VendorController@deleteVendor'); //Delete a vendor


    //Shops stuff
    Route::get('shops','ShopController@getShops');
    Route::get('shops/info','ShopController@shopInfo');
    Route::post('shops','ShopController@createShop');
    Route::post('shops/item','ShopController@addItemToShop');
    Route::put('shops','ShopController@editShop');
    Route::put('shops/vendor','ShopController@editShopVendor');
    Route::delete('shops','ShopController@deleteShop');
    Route::delete('shops/item','ShopController@deleteItemFromShop');


    //Affiliates stuff
    Route::get('affiliates',function(){
        echo "affiliates";
    });

    Route::get('counts','GetController@getAllCount');

});

//Main page
Route::get('/','GetController@createMainPage')->name('home');
Route::get('/home','GetController@createMainPage');

//User confirmation
Route::get('/confirm/{confirmationCode}','Auth\RegisterController@confirm');

//Thread section
//Route::get('/thread','GetController@createThreadPage');
Route::post('/{channelId}',"ThreadController@createThread")->where('channelId','[0-9]+');


//User things (get page/update avatar)
Route::get('/user/{userName}','UserController@getUserPage');
Route::post('/user/{userName}','UserController@updateUserAvatar');
//Handle the "tab" section
Route::get('/user/{userName}/getItems','UserController@loadUserItems');
Route::get('/user/{userName}/getLastMessages','UserController@getUserLastMessages');
Route::get('/user/{userName}/getBadges');
Route::get('/user/{userName}/getCharacterCards');
Route::get('/user/{userName}/getCombatCards');



//Thread management
Route::get('/{channelId}','GetController@createChannelPage')->where('channelId','[0-9]+');
Route::get('/{channelId}/{threadId}','GetController@renderThreadPage')->where(['channelId'=>'[0-9]+','threadId'=>'[0-9]+']);
Route::post('/{channelId}/{threadId}','ThreadController@createPost')->where(['channelId'=>'[0-9]+','threadId'=>'[0-9]+']);
Route::put('/post','UpdateElementController@editPost');
Route::get('/post','GetController@getPostText');


//Shop management
Route::get('/shop','ShopController@shopMenu');
Route::get('/shop/{shopId}','ShopController@shopInside')->where('shopId','[0-9]+');
Route::post('/shop','ShopController@buyItem');



/** Close/open threads and channels **/
Route::put('/thread/alter','UpdateElementController@alterThreadStatus');
Route::put('/channel/alter','UpdateElementController@alterChannelStatus');

Route::post('/chatmessage','chatController@sendMessage');
