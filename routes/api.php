<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FriendController.php;
use App\Http\Controllers\GamesController.php;
use App\Http\Controllers\MemberController.php;
use App\Http\Controllers\MessageController.php;
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

// Games CRUD
Route::get('/games', [GamesController::class, 'showGames']);
Route::post('/games', [GamesController::class, 'addGame']);
Route::get('/games/{id}', [GamesController::class, 'showGameById']);
Route::put('/games/{id}', [GamesController::class, 'updateGameById']);
Route::delete('/games/{id}', [GamesController::class, 'deleteGameById']);

// Parties CRUD
Route::get('/parties', [PartiesController::class, 'showParties']);
Route::post('/parties', [PartiesController::class, 'addParty']);
Route::get('/parties/{id}', [PartiesController::class, 'showPartyById']);
Route::put('/parties/{id}', [PartiesController::class, 'updatePartyById']);
Route::delete('/parties/{id}', [PartiesController::class, 'deletePartyById']);
Route::get('/parties/game/{id}', [PartiesController::class, "showPartiesByGameID"]);

