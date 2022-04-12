<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showAllMessages()
    {
        Log::info('showAllMessages()');

        try {

            $messages = Message::all();

            Log::info('Messages shown');

            return response()->json($messages, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Couldn not show messages'], 500);
        }
    }

    public function addMessage(Request $request)
    {
        Log::info('addMessage()');

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

            Log::info('Message created');

            return response()->json($message, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not shown message'], 500);
        }
    }

    public function showMessageById($id)
    {
        Log::info('showMessageById()');

        try {

            $message = Message::find($id);

            Log::info('showing message');

            return response()->json($message, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not show message'], 500);
        }
    }

    public function updateMessageById(Request $request, $id)
    {
        Log::info('updateMessageById()');

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

            Log::info('message updated succesfully');

            return response()->json($message, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not update message'], 500);
        }
    }

    public function deleteMessageById($id)
    {
        Log::info('deleteMessageById()');

        try {

            $message = Message::find($id);

            $message->delete();

            Log::info('Message deleted');

            return response()->json($message, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not delete message'], 500);
        }
    }

    public function showMessagesByPartyId($id)
    {
        Log::info('showMessagesByPartyId()');

        try {

            $messages = Message::where('partyId', $id)->get();

            Log::info('message shown');

            return response()->json($messages, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not show message'], 500);
        }
    }

    public function showMessagesByUserId($id)
    {
        Log::info('showMessagesByUserId()');

        try {

            $messages = Message::where('writerMember', $id)->get();

            Log::info('message shown');

            return response()->json($messages, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not show message'], 500);
        }
    }
}