<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Models\Profile;
use App\Models\Privilege;
use App\Mail\UserRegitered;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        if (isset($request->address)) {
            $profile = Profile::create([
        'address' => $request->address,
        'phone' => $request->phone,
        'user_id' => $user->id
        ]);

            // if (isset($request->image)) {
    //     $profile = Profile::create([
    //     'address' => $request->address,
    //     'phone' => $request->phone,
    // ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        Mail::to($user)->send(new UserRegitered($user));

        $privileges = Privilege::where('name', 'admin')->get();

        foreach ($privileges as $privilege) {

            $admin = User::find($privilege->user_id);
            Mail::to($admin)->send(new UserRegitered($user));
        }

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
