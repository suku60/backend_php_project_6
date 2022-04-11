<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FriendsController.php;
use App\Http\Controllers\GamesController.php;
use App\Http\Controllers\MemberController.php;
use App\Http\Controllers\MessagesController.php;
use App\Http\Controllers\PartiesController.php;
use App\Http\Controllers\UsersController.php;

// we have to import authcontroller once we create and have it

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Users CRUD
Route::get('/users/username', [AuthController::class, 'showUser']);
Route::get('/users/show', [UserController::class, 'showUsers']);
Route::get('/users/show/{id}', [UserController::class, 'showUserById']);
Route::put('/users/update/{id}', [UserController::class, 'updateUserById']);
Route::delete('/users/delete/{id}', [UserController::class, 'deleteUserById']);

// Games CRUD
Route::get('/games/show', [GamesController::class, 'showGames']);
Route::post('/games/add', [GamesController::class, 'addGame']);
Route::get('/games/show/{id}', [GamesController::class, 'showGameById']);
Route::put('/games/update/{id}', [GamesController::class, 'updateGameById']);
Route::delete('/games/delete/{id}', [GamesController::class, 'deleteGameById']);

// Parties CRUD
Route::get('/parties/show', [PartiesController::class, 'showParties']);
Route::post('/parties/add', [PartiesController::class, 'addParty']);
Route::get('/parties/show/{id}', [PartiesController::class, 'showPartyById']);
Route::put('/parties/update/{id}', [PartiesController::class, 'updatePartyById']);
Route::delete('/parties/delete/{id}', [PartiesController::class, 'deletePartyById']);
// using fk
Route::get('/parties/show/game/{id}', [PartiesController::class, 'showPartiesByGameID']);

// Messages CRUD
Route::post('/messages/add', [MessagesController::class, 'addMessage']);
Route::get('/messages/show/all', [MessagesController::class, 'showAllMessages']);
Route::get('/messages/show/{id}', [MessagesController::class, 'showMessageById']);
Route::put('/messages/update/{id}', [MessagesController::class, 'updateMessageById']);
Route::delete('/messages/delete/{id}', [MessagesController::class, 'deleteMessageById']);
// using fk
Route::get('/messages/show/party/{id}', [MessagesController::class, 'showMessageByPartyId']);
