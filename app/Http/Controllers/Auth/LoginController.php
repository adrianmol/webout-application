<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Webout Services | Dashboard';

        return view('auth.login',
            [
                'title' => $title,
            ]
        );
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->getCredentials();

        if (! Auth::validate($credentials)) {

            return redirect()->back()->withErrors('Unauthorized: Invalid credentials.');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
