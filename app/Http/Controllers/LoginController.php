<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Validation\EmailValidator;
use App\Models\User;

class LoginController extends Controller
{
    use EmailValidator;

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $exposedAttributes = [
            'name',
            'email',
        ];
        $response = (object)[
            'isLoggedIn' => false,
            'user' => null,
            'session' => (object)[
                'lifetime' => intval(env('SESSION_LIFETIME', 120))
            ]
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $response->isLoggedIn = true;
            $response->user = $request->user()->only($exposedAttributes);
        }

        return json_encode($response);
    }

    public function register (Request $request)
    {
        $minPasswordLength = 8;

        $email = $request->input('email');
        $password = $request->input('password');

        if ($this->testEmail($email) && strlen($password) >= $minPasswordLength) {
            $isEmailExisting = User::where('email', $email)->exists();
            if($isEmailExisting){
                abort(422, 'Email already exists');
            }

            try{
                $user = User::create([
                    'email' => $email,
                    'password' => bcrypt($password),
                ]);
    
                return response('Registration success', 201);
            }catch(Exception $ex) {
                abort(500, 'Cannot create new user');
            }
        }

        return abort(422, 'Invalid email or password');
    }

    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
