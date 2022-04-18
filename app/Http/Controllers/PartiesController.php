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
            info('showParties()');
            try {
                $parties = Party::all();

                return response()->json($parties, 200);
                
            } catch (\Exception $e) {
    
    
                return response()->json(['message' => 'Could not show all parties'], 500);
            }
    }
        public function addParty(Request $request)
    {
    
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
    
    
                return response()->json($party, 200);
    
            } catch (\Exception $e) {
    
    
                return response()->json(['message' => 'Could not create party'], 500);
            }
    }
    public function showPartyById($id)
    {

            try {

                $party = Party::find($id);


                return response()->json($party, 200);

            } catch (\Exception $e) {


                return response()->json(['message' => 'Could not show party, Id may not exist'], 500);
            }
    }
    public function updatePartyById(Request $request, $id)
    {

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


                return response()->json($party, 200);

            } catch (\Exception $e) {


                return response()->json(['message' => 'Party updated succesfully'], 500);
            }
    }
    public function deletePartyById($id)
    {

            try {

                $party = Party::find($id);

                $party->delete();


                return response()->json(['message' => 'Party deleted'], 200);

            } catch (\Exception $e) {


                return response()->json(['message' => 'Could not delete'], 500);
            }
    }
    public function partiesByGameId($id)
    {

            try {

                $parties = Party::where('gameId', $id)->get();


                return response()->json($parties, 200);

            } catch (\Exception $e) {


                return response()->json(['message' => 'Could not show party'], 500);
            }
    }

}