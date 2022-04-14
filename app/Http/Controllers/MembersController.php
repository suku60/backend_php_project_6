<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function showMembers()
    {
        Log::info('showMembers()');

        try {

            $members = Member::all();

            Log::info('Members shown');

            return response()->json($members, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not show members'], 500);
        }
    }

    public function addMember(Request $request)
    {
        Log::info('addMember()');

        try {

            $validator = Validator::make($request->all(), [
                'partyId' => 'required|integer|max:255',
                'userId' => 'required|integer|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Could not find member'], 400);
            }

            $member = Member::create([
                'partyId' => $request->partyId,
                'userId' => $request->userId,
            ]);

            Log::info('Member added succesfully');

            return response()->json($member, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not add member'], 500);
        }
    }

    public function showMemberById($id)
    {
        Log::info('showMemberById()');

        try {

            $member = Member::find($id);

            Log::info('showing members by Id');

            return response()->json($member, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not show members'], 500);
        }
    }

    public function updateMemberById(Request $request, $id)
    {
        Log::info('updateMemberById()');

        try {

            $validator = Validator::make($request->all(), [
                'partyUserTag' => 'required|string|max:7',
                'partyName' => 'required|string|max:40',
                'partyId' => 'required|integer|max:255',
                'userId' => 'required|integer|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Could not update member'], 400);
            }

            $member = Member::find($id);

            $member->partyUserTag = $request->partyUserTag;
            $member->partyName = $request->partyName;
            $member->partyId = $request->partyId;
            $member->userId = $request->userId;

            $member->save();

            Log::info('Member updated');

            return response()->json($member, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not update member'], 500);
        }
    }

    public function deleteMemberById($id)
    {
        Log::info('deleteMemberById()');

        try {

            $member = Member::find($id);

            if (!$member) {
                return response()->json(['message' => 'Member not found'], 404);
            }

            $member->delete();

            Log::info('Member deleted');

            return response()->json(['message' => 'Member deleted'], 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not delete member'], 500);
        }
    }

    public function showMembersByPartyId($id)
    {
        Log::info('showMembersByPartyId()');

        try {

            $member = Member::where('partyId', $id)->get();

            Log::info('party members shown');

            return response()->json($member, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not show members'], 500);
        }
    }

     public function deleteAllPartyMembersByPartyId($id)
    {
        Log::info('deleteAllPartyMembersByPartyId()');

        try {

            $member = Member::where('partyId', $id)->delete();


            Log::info('party members deleted');

            return response()->json($member, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not delete members'], 500);
        }
    }

}