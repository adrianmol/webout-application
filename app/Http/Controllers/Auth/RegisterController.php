<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $title = 'Webout Services | Dashboard';

        return view('auth.register',
            [
                'title' => $title,
            ]
        );
    }

    public function register(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validated->fails()) {

            return view('auth.register', ['messages' => $validated->errors()->messages()]);
        }

        $userStoreData = $request->all();
        $userStoreData['password'] = bcrypt($userStoreData['password']);

        $user = User::create($userStoreData);

        $token = $user->createToken('AppWeboutServices')->plainTextToken;

        return redirect('dashboard.index');
    }
}
