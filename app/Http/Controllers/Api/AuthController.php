<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckLoginRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller {

    public function login(CheckLoginRequest $request) {

        // Validation done through Request

        $user = User::where('email', $request->email)->first(); // Check User Availability

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        /**
         * On frontend part, store token and use as a Bearer Token in Header as type = Authorization
         */
        $token =  $user->createToken($request->device_name)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, Response::HTTP_CREATED); // HTTP_CREATED is 201 or use 200 as HTTP_OK
    }

}
