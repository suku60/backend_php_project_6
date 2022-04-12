<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function showFriends()
    {
        Log::info('showFriends()');

        try {

            $friend = Friend::all();

            Log::info('Friends shown');

            return response()->json($friend, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not show friends'], 500);
        }
    }

    public function addFriend(Request $request)
    {
        Log::info('addFriend()');

        try {

            $validator = Validator::make($request->all(), [
                'partyId' => 'required|integer|max:255',
                'userId' => 'required|integer|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Could not find Friend'], 400);
            }

            $friend = Friend::create([
                'user1_id' => $request->user1_id,
                'user2_id' => $request->user2_id,
            ]);

            Log::info('Friend added succesfully');

            return response()->json($friend, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not add friend'], 500);
        }
    }

    public function showFriendById($id)
    {
        Log::info('showFriendById()');

        try {

            $friend = Friend::find($id);

            Log::info('showing friends by Id');

            return response()->json($friend, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not show friends'], 500);
        }
    }

    public function updateFriendById(Request $request, $id)
    {
        Log::info('updateFriendById()');

        try {

            $validator = Validator::make($request->all(), [
                'user1_Id' => 'required|integer|max:255',
                'user2_Id' => 'required|integer|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Could not update friend'], 400);
            }

            $friend = Friend::find($id);

            $friend->user1_Id = $request->user1_Id;
            $friend->user2_Id = $request->user2_Id;

            $friend->save();

            Log::info('Friend updated');

            return response()->json($friend, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not update Friend'], 500);
        }
    }

    public function deleteFriendById($id)
    {
        Log::info('deleteFriendById()');

        try {

            $friend = Friend::find($id);

            if (!$friend) {
                return response()->json(['message' => 'Friend not found'], 404);
            }

            $friend->delete();

            Log::info('Friend deleted');

            return response()->json(['message' => 'Friend deleted'], 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not delete friend'], 500);
        }
    }

}