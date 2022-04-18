<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function showMembers()
    {
        info('showMembers()');

        try {

            $members = Member::all();


            return response()->json($members, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not show members'], 500);
        }
    }
    public function addMember(Request $request)
    {

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


            return response()->json($member, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not add member'], 500);
        }
    }
    public function showMemberById($id)
    {

        try {

            $member = Member::find($id);


            return response()->json($member, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not show members'], 500);
        }
    }
    public function updateMemberById(Request $request, $id)
    {

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


            return response()->json($member, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not update member'], 500);
        }
    }
    public function deleteMemberById($id)
    {

        try {

            $member = Member::find($id);

            if (!$member) {
                return response()->json(['message' => 'Member not found'], 404);
            }

            $member->delete();


            return response()->json(['message' => 'Member deleted'], 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not delete member'], 500);
        }
    }
    public function showMembersByPartyId($id)
    {

        try {

            $member = Member::where('partyId', $id)->get();


            return response()->json($member, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not show members'], 500);
        }
    }

     public function deleteAllPartyMembersByPartyId($id)
    {

        try {

            $member = Member::where('partyId', $id)->delete();



            return response()->json($member, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not delete members'], 500);
        }
    }

}