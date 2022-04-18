<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class UsersController extends Controller
{   
    public function addUser(Request $request)
    {
        Log::info('addUser()');

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:14',
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $user = User::create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function logUser(Request $request)
    {
        Log::info('logUser()');

        $input = $request->only('username', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong password or username',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function showMyUser()
    {
        Log::info('showMyUser()');

       return response()->json(auth()->user());;
    }

    public function logOutUser(Request $request)
    {
        Log::info('logOutUser()');
      
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'Logged out'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error logging out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showUsers()
    {
        Log::info('showUsers()');

        try {

            $users = User::all();

            Log::info('Showing all users');

            return $users;

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Error: could not show all users'], 500);
        }
    }
    public function showUserById($id)
    {
        Log::info('showUserById()');

        try {

            $user = User::find($id);

            Log::info('Showing user by Id');

            return response()->json($user, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Error showing user by Id'], 500);
        }
    }
    public function updateUserById(Request $request, $id)
    {
        Log::info('updateUserById()');

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:14',
                'email' => 'required|string|email|max:100',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed'], 400);
            }

            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();

            Log::info('User updated succesfully');

            return response()->json($user, 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Error: data update failed'], 500);
        }
    }
    public function deleteUserById($id)
    {
        Log::info('deleteUserById()');

        try {

            $user = User::find($id);

            $user->delete();

            Log::info('User deleted succesfully');

            return response()->json(['message' => 'User deleted succesfully'], 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['message' => 'Error: could not delete user'], 500);
        }
    }
}

// further develop showUserGames - showPartiesWhereUserIsMember
