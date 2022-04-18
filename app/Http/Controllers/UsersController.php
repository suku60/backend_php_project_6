<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class UsersController extends Controller
{  
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
    public function showUsersByCompanyArea($request)
    {
            Log::info('showUsersByCompanyArea()');

            try {

                $users = Party::where('company_area', $request)->get();

                Log::info('showing users by area');

                return response()->json($users, 200);

            } catch (\Exception $e) {

                Log::error($e->getMessage());

                return response()->json(['message' => 'No users from this area'], 500);
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
