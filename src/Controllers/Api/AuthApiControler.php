<?php

namespace Mariojgt\Firetakeaway\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Mariojgt\Firetakeaway\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mariojgt\Firetakeaway\Events\UserVerifyEvent;
use Validator;

class AuthApiControler extends Controller
{
    /**
     * Login Logic
     *
     * @param Request $request
     *
     * @return [blade]
     */
    public function login(Request $request)
    {
        // Validate the user
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // If Validation Fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Credentials for the login
        $credentials = $request->only('email', 'password');
        // Try login
        if (Auth::attempt($credentials)) {
            // Create the device name
            $tokenName = $_SERVER['SERVER_NAME'] . '-' . Request('device') ?? Carbon::now();
            // Return the sanctum token that will be used in the api
            $token = Auth::user()->createToken($tokenName)->plainTextToken;

            return response()->json([
                'raw_token' => $token,
                'token'     => explode('|', $token)[1],
                'status'    => true,
            ]);
        } else {
            return response()->json([
                'data' => 'User not found',
            ], 401);
        }
    }

    /**
     * Aplication Registration logic
     *
     * @param Request $request
     *
     * @return [type]
     */
    public function register(Request $request)
    {
        // Validate the data
        $validator = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // If Validation Fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Create the user
        $user           = new User();
        $user->name     = Request('name');
        $user->email    = Request('email');
        $user->password = Hash::make(Request('password'));
        $user->save();

        // Send the verification to the user
        UserVerifyEvent::dispatch($user);

        return response()->json([
            'data' => 'User Created with success please verify your email.',
        ]);
    }

    // Check boot token
    public function checkConnection()
    {
        return response()->json([
            'app_name' => env('APP_NAME'),
            'version'  => config('firetakeaway.version'),
            'message'  => 'Boot Token authentication with success',
            'status'   => true,
        ]);
    }

    // Check if this url is valid
    public function checkUrl()
    {
        return response()->json([
            'version'  => 'Connection successful.',
            'status'   => true,
        ]);
    }
}
