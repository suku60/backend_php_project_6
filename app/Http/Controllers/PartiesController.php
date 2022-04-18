<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Users;
use App\Models\Parties;

use Illuminate\Http\Request;

class PartiesController extends Controller
{
    public function showParties()
    {
            Log::info('showParties()');
            try {
                $parties = Party::all();
                Log::info('Showing all parties');

                return response()->json($parties, 200);
                
            } catch (\Exception $e) {
    
                Log::error($e->getMessage());
    
                return response()->json(['message' => 'Could not show all parties'], 500);
            }
    }
        public function addParty(Request $request)
    {
            Log::info('addParty()');
    
            try {
    
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:400',
                    'description' => 'required|string|max:400',
                    'creatorId' => 'required|string|max:255',
                    'gameId' => 'required|string|max:255',
                ]);
    
                if ($validator->fails()) {
                    return response()->json(['message' => 'Name and description need to be filled'], 400);
                }
    
                $party = Party::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'creatorId' => $request->creatorId,
                    'gameId' => $request->gameId,
                ]);
    
                Log::info('Party created');
    
                return response()->json($party, 200);
    
            } catch (\Exception $e) {
    
                Log::error($e->getMessage());
    
                return response()->json(['message' => 'Could not create party'], 500);
            }
    }
    public function showPartyById($id)
    {
            Log::info('showPartyById()');

            try {

                $party = Party::find($id);

                Log::info('Showing party by desired Id');

                return response()->json($party, 200);

            } catch (\Exception $e) {

                Log::error($e->getMessage());

                return response()->json(['message' => 'Could not show party, Id may not exist'], 500);
            }
    }
    public function updatePartyById(Request $request, $id)
    {
            Log::info('updatePartyById()');

            try {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:400',
                    'description' => 'required|string|max:400',
                    'creatorId' => 'required|string|max:255',
                    'gameId' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json(['message' => 'Couldnt not update, data possibly wrong'], 400);
                }

                $party = Party::find($id);

                $party->name = $request->name;
                $party->description = $request->description;
                $party->creatorId = $request->creatorId;
                $party->gameId = $request->gameId;

                $party->save();

                Log::info('Party updated');

                return response()->json($party, 200);

            } catch (\Exception $e) {

                Log::error($e->getMessage());

                return response()->json(['message' => 'Party updated succesfully'], 500);
            }
    }
    public function deletePartyById($id)
    {
            Log::info('deletePartyById()');

            try {

                $party = Party::find($id);

                $party->delete();

                Log::info('Deleting party');

                return response()->json(['message' => 'Party deleted'], 200);

            } catch (\Exception $e) {

                Log::error($e->getMessage());

                return response()->json(['message' => 'Could not delete'], 500);
            }
    }
    public function partiesByGameId($id)
    {
            Log::info('partiesByGameId()');

            try {

                $parties = Party::where('gameId', $id)->get();

                Log::info('Party gotten by game Id');

                return response()->json($parties, 200);

            } catch (\Exception $e) {

                Log::error($e->getMessage());

                return response()->json(['message' => 'Could not show party'], 500);
            }
    }

}