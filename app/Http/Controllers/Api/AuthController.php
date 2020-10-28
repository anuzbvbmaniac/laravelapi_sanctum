<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckLoginRequest;
use App\User;
use http\Env\Request;
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
        $token = $user->createToken($request->device_name)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, Response::HTTP_CREATED); // HTTP_CREATED is 201 or use 200 as HTTP_OK


//  ##### Example Code for Login. React Native:
//        login: (email, password, device_name) => {
//            axios.post('/login', {
//                email,
//                password,
//                device_name,
//            })
//            .then(response => {
//                const userResponse = {
//                    email: response.data.user.email,
//                    token: response.data.token,
//                }
//                setUser(userResponse);
//                SecureStorage.setItemAsync('user', JSON.stringfy(userResponse));
//            })
//            .catch(error => {
//                console.log(error.response);
//            })
//        }

//  ##### Example Code for other api endpoint. React Native:
//        function() {
//              axios.defaults.headers.common["Authorization"] = `Bearer ${user.token}`;
//              axios.get('/api/categories')
//              .then(response => {
//                  # DO Something
//              })
//              .catch(error => {
//                  console.log(error.response);
//              })
//        }

    }

    public function logout(Request $request) {
        $request->user()->tokens()->where('id', $id)->delete();
        return response("Logged Out", Response::HTTP_OK);

//  ##### Example Code for Logout. React Native:
//        logout: () => {
//            axios.defaults.headers.common["Authorization"] = `Bearer ${user.token}`;
//            axios.post('/api/logout')
//            .then(response => {
//                setUser(null);
//                SecureStorage.deleteItemAsync('user');
//            })
//            .catch(error => {
//                  console.log(error.response);
//            })
    }

}

}
