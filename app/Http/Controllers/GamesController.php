<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function showGames()
    {
        Log::info('showGames()');
        
        try {

            $games = Game::all();
            
            Log::info('Games shown');

            return response()->json($games, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not shown all games'], 500);
        }
    }
    public function addGaame(Request $request)
    {
        Log::info('addGame()');

        try {

            $validator = Validator::make($request->all(), [
                'gameName' => 'required|string|max:400',
                'description' => 'required|string|max:400',
                'img_url' => 'required|string|max:255',
                'website' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed'], 400);
            }

            $game = Game::create([
                'gameName' => $request->gameName,
                'description' => $request->description,
                'img_url' => $request->img_url,
                'website' => $request->url,
            ]);

            Log::info('game created');

            return response()->json($game, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Couldn not create3 game'], 500);
        }
    }
    public function showGameById($id)
    {
        Log::info('showGameById()');

        try {

            $game = Game::find($id);

            if (!$game) {
                return response()->json(['message' => 'Game not found'], 404);
            }

            Log::info('Game found');

            return response()->json($game, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not find game'], 500);
        }
    }
    public function updateGameById($id, Request $request)
    {
        Log::info('updateGame()');

        $gameName = $request->input('gameName');
        $description = $request->input('description');
        $img_url = $request->input('img_url');
        $website = $request->input('website');

        try {

            $game = Game::find($id);

            if (!$game) {
                return response()->json(['message' => 'Game not found'], 404);
            }

            $game->gameName = $gameName;
            $game->description = $description;
            $game->img_url = $img_url;
            $game->website = $website;

            $game->save();

            Log::info('Tasks done');

            return response()->json($game, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    public function deleteGameById($id)
    {
        Log::info('deleteGameById()');

        try {

            $game = Game::find($id);

            if (!$game) {
                return response()->json(['message' => 'Game not found'], 404);
            }

            $game->delete();

            Log::info('Game found');

            return response()->json(['message' => 'Deleted desired game'], 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not delete'], 500);
        }
    }
}

