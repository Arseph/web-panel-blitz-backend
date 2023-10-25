<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $exposedAttributes = [
            'name',
            'email',
        ];

        return $request->user()->only($exposedAttributes);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $oldPassword = $request->input('oldPassword');

        $updatePayload = [
            'name' => $name,
            'email' => $email,
        ];

        if(isset($password)){
            array_merge($updatePayload, [
                'password' => bcrypt($password),
            ]);
        }

        if($user->update($updatePayload)){
            return response('Changes saved!', 200);
        }

        return response('Changes cannot be saved. Please try again', 500);
    }
}
