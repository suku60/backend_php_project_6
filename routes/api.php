<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\PartiesController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MessagesController;

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
// Route::post('/users/add', [AuthController::class, 'addUser']);
// Route::post('/users/log', [AuthController::class, 'logUser']);
// Route::get('/users/username', [AuthController::class, 'showMyUser']);
Route::get('/users/show', [UserController::class, 'showUsers']);
Route::get('/users/show/{id}', [UserController::class, 'showUserById']);
Route::put('/users/update/{id}', [UserController::class, 'updateUserById']);
Route::delete('/users/delete/{id}', [UserController::class, 'deleteUserById']);
// using fk
// Route::get('/users/show/games', [UserController::class, 'showUserGames']);
// Route::get('/users/show/parties/member/{id}', [UserController::class, 'showPartiesWhereUserIsMember']);

// Games CRUD
Route::post('/games/add', [GamesController::class, 'addGame']);
Route::get('/games/show', [GamesController::class, 'showGames']);
Route::get('/games/show/{id}', [GamesController::class, 'showGameById']);
Route::put('/games/update/{id}', [GamesController::class, 'updateGameById']);
Route::delete('/games/delete/{id}', [GamesController::class, 'deleteGameById']);

// Parties CRUD
Route::post('/parties/add', [PartiesController::class, 'addParty']);
Route::get('/parties/show', [PartiesController::class, 'showParties']);
Route::get('/parties/show/{id}', [PartiesController::class, 'showPartyById']);
Route::put('/parties/update/{id}', [PartiesController::class, 'updatePartyById']);
Route::delete('/parties/delete/{id}', [PartiesController::class, 'deletePartyById']);
// using fk
Route::get('/parties/show/game/{id}', [PartiesController::class, 'showPartiesByGameId']);

// Messages CRUD
Route::post('/messages/add', [MessagesController::class, 'addMessage']);
Route::get('/messages/show/all', [MessagesController::class, 'showAllMessages']);
Route::get('/messages/show/{id}', [MessagesController::class, 'showMessageById']);
Route::put('/messages/update/{id}', [MessagesController::class, 'updateMessageById']);
Route::delete('/messages/delete/{id}', [MessagesController::class, 'deleteMessageById']);
// using fk
Route::get('/messages/show/party/{id}', [MessagesController::class, 'showMessageByPartyId']);
Route::get('/messages/show/user/{id}', [MessagesController::class, 'showMessageByUserId']);

// Members CRUD
Route::post('/members/add', [MembersControllers::class, 'addMember']);
Route::get('/members/show', [MembersControllers::class, 'showMembers']);
Route::get('/members/show/{id}', [MembersControllers::class, 'showMemberById']);
Route::put('/members/update/{id}', [MembersControllers::class, 'updateMemberById']);
Route::delete('/members/delete/{id}', [MembersControllers::class, 'deleteMemberById']);
// using fk 
// Route::get('/members/party/{id}', [MembersControllers::class, "showMembersByPartyId"]);
// Route::get('/members/delete/party/{id}', [MembersControllers::class, "deleteAllPartyMembersByPartyId"]);

// Friends CRUD
Route::get('/friends/add', [FriendsControllers::class, 'addFriend']);
Route::post('/friends/show', [FriendsControllers::class, 'showFriends']);
Route::get('/friends/show/{id}', [FriendsControllers::class, 'showFriendById']);
Route::put('/friends/update/{id}', [FriendsControllers::class, 'updateFriendById']);
Route::delete('/friends/delete/{id}', [FriendsControllers::class, 'deleteFriendById']);
