<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function showFriends()
    {

        try {

            $friend = Friend::all();


            return response()->json($friend, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not show friends'], 500);
        }
    }
    public function addFriend(Request $request)
    {

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


            return response()->json($friend, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not add friend'], 500);
        }
    }
    public function showFriendById($id)
    {

        try {

            $friend = Friend::find($id);


            return response()->json($friend, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not show friends'], 500);
        }
    }
    public function updateFriendById(Request $request, $id)
    {

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


            return response()->json($friend, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not update Friend'], 500);
        }
    }
    public function deleteFriendById($id)
    {

        try {

            $friend = Friend::find($id);

            if (!$friend) {
                return response()->json(['message' => 'Friend not found'], 404);
            }

            $friend->delete();


            return response()->json(['message' => 'Friend deleted'], 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not delete friend'], 500);
        }
    }

}