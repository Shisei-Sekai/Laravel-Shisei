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
    Route::post('categories','ThreadController@createCategory'); //Create category
    Route::put('categories','UpdateElementController@updateCategory'); //Edit category
    Route::delete('categories','CleanController@deleteCategory'); //Delete category and it's channels, threads and posts


    //Channels stuff
    Route::get('channels','GetController@getChannels'); //Get channels of determined category
    Route::post('channels','ThreadController@createChannel'); //Create channel in determined category
    Route::delete('channels','CleanController@deleteChannel'); //Delete category from channel


    //Affiliates stuff
    Route::get('affiliates',function(){
        echo "affiliates";
    });

});

Route::get('/','GetController@createMainPage')->name('home');
Route::get('/home','GetController@createMainPage');
Route::get('/thread','GetController@createThreadPage');
Route::post('/threads/{channelId}',"ThreadController@createThread")->where('channelId','[0-9]+');
Route::get('/user/{userName}','GetController@getUserPage');
Route::post('/user/{userName}','UpdateElementController@updateUserAvatar');
Route::get('/{channelId}','GetController@createChannelPage')->where('channelId','[0-9]+');
Route::get('/{channelId}/{threadId}','GetController@renderThreadPage')->where(['channelId'=>'[0-9]+','threadId'=>'[0-9]+']);
Route::post('/{channelId}/{threadId}','ThreadController@createPost')->where(['channelId'=>'[0-9]+','threadId'=>'[0-9]+']);


