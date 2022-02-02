<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends CommonController
{
    public function signin(Request $request)
    {
       // dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            switch ($authUser->role) {
                case ROLE_WP_MANAGER:
                    $success['token'] =  $authUser->createToken('apiToken', ['wallpaper:manage'])->plainTextToken;
                    break;
            }
            $success['name'] =  $authUser->name;

            return $this->sendResponse($success, 'User signed in');
        } else {
            return $this->sendError('Unauthorized.', ['error' => 'invalid login data']);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        //TODO: get role from admin frontend
        $input['role'] = ROLE_WP_MANAGER;
        $user = User::create($input);
        switch ($user->role) {
            case ROLE_WP_MANAGER:
                $success['token'] =  $authUser->createToken('apiToken', ['wallpaper:manage'])->plainTextToken;
                break;
        }
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User created successfully.');
    }
    public function test()
    {
        if (auth()->check()) {
            return response()->json([
                'login' => auth()->user()->name,
            ]);
        } else {
            return response()->json([
                'login' => 'no',
            ]);
        }
    }
}
