<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('chat/saveAudioBlob', 'App\Http\Controllers\ChatController@saveAudioBlob');

Route::group(['prefix' => 'api', 'namespace'  => 'App\Http\Controllers\Api'], function (){

    
    Route::get('userHash/{hash}', 'UsersController@userHash');
    Route::get('users', 'UsersController@index');
    Route::get('users/{id}', 'UsersController@show');
    Route::get('authuser', 'UsersController@authUser');
    Route::get('messages', 'MessagesController@authUserMessages');
    Route::post('createMessage', 'MessagesController@createMessage');
    Route::post('createChatGroup', 'ThreadsController@createChatGroup');
    Route::post('createUserThread', 'ThreadsController@createUserThread');
    Route::get('threadUsers', 'ThreadsController@threadUsers');
    Route::get('searchUsers', 'ThreadsController@searchUsers');
    Route::get('searchGroups', 'ThreadsController@searchGroups');
    Route::get('userSubscribedThreads', 'ThreadsController@userSubscribedThreads');
    Route::get('threadData', 'ThreadsController@threadData');

});