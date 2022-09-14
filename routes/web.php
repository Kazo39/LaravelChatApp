<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FriendshipController;
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

Route::group(['middleware' => 'auth'], function ($router){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::get('/sentRequest/{user}', [FriendshipController::class, 'sendRequest'])->name('send-request');
    Route::get('/index', [FriendshipController::class, 'index'])->name('all-friends');
    Route::get('/friendship-requests', [FriendshipController::class, 'friendshipRequests'])->name('all-friendship-requests');
    Route::get('/friendship-requests-sent', [FriendshipController::class, 'friendshipRequestsSent'])->name('friendship-requests-sent');
    Route::get('/accept-friendship-request/{user}', [FriendshipController::class, 'acceptFriendshipRequest'])->name('accept-friendship-request');
    Route::get('/ignore-friendship-request/{user}', [FriendshipController::class, 'ignoreFriendshipRequest'])->name('ignore-friendship-request');
    Route::get('/remove-friendship-request/{user}', [FriendshipController::class, 'removeFriendshipRequest'])->name('remove-friendship-request');
    Route::get('/open-chat/{user}', [MessageController::class, 'index'])->name('open-chat');
    Route::get('/show-messages/{user}', [MessageController::class, 'showMessages'])->name('show-messages');
    Route::post('/send-message', [MessageController::class, 'store'])->name('send-message');
});

Auth::routes();


