<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showAllMessages()
    {

        try {

            $messages = Message::all();


            return response()->json($messages, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Couldn not show messages'], 500);
        }
    }
    public function addMessage(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:400',
                'date' => 'required|date|max:50',
                'writerMember' => 'required|integer',
                'partyId' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Could not show message'], 400);
            }

            $message = Message::create([
                'message' => $request->message,
                'date' => $request->date,
                'witerMember' => $request->writerMember,
                'partyId' => $request->partyId,
            ]);


            return response()->json($message, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not shown message'], 500);
        }
    }
    public function showMessageById($id)
    {

        try {

            $message = Message::find($id);


            return response()->json($message, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not show message'], 500);
        }
    }
    public function updateMessageById(Request $request, $id)
    {

        try {

            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:400',
                'date' => 'required|date|max:50',
                'writerMember' => 'required|integer',
                'partyId' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Could not update message'], 400);
            }

            $message = Message::find($id);

            $message->message = $request->message;
            $message->date = $request->date;
            $message->writerMember = $request->writerMember;
            $message->partyId = $request->partyId;

            $message->save();


            return response()->json($message, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not update message'], 500);
        }
    }
    public function deleteMessageById($id)
    {

        try {

            $message = Message::find($id);

            $message->delete();


            return response()->json($message, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not delete message'], 500);
        }
    }
    public function showMessagesByPartyId($id)
    {

        try {

            $messages = Message::where('partyId', $id)->get();


            return response()->json($messages, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not show message'], 500);
        }
    }
    public function showMessagesByUserId($id)
    {

        try {

            $messages = Message::where('writerMember', $id)->get();


            return response()->json($messages, 200);

        } catch (\Exception $e) {


            return response()->json(['message' => 'Could not show message'], 500);
        }
    }
}