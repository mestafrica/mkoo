<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;


class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }

        return view('auth.login');
    }

    /**
     * Redirect the user to Google authentication page
     *
     * @return mixed
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleProviderCallback()
    {
        try {
            $googleUserProfile = Socialite::driver('google')->user();

            if (! $this->hasValidDomain($googleUserProfile->email)){
                flash()->error('Invalid email address. You must login with a valid @meltwater.org or a MINC company email address.');

                return redirect()->route('login');
            }

        } catch (\Exception $e) {
            logger('Exception occurred whiles signing in', ['error' => $e->getMessage()]);

            flash()->error('An error occurred. Please check to make sure you have a working internet connection.');

            return redirect()->route('login');
        }

        $user = $this->findOrCreateUser($googleUserProfile);

        auth()->login($user, true);

        flash()->success('Welcome back, '. $user->name);

        return redirect()->route('dashboard.index');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $googleUser
     * @return User
     */
    private function findOrCreateUser($googleUser)
    {
        if ($user = User::where('google_id', $googleUser->id)->first()) {
            return $user;
        }

        return User::create([
            'first_name' => $googleUser->name,
            'last_name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'avatar' => $this->getOriginalAvatar($googleUser),
            'gender' => $googleUser->getRaw()['gender'] ?? null,
        ]);
    }

    private function getOriginalAvatar($googleUserProfile)
    {
        return explode('?', $googleUserProfile->avatar)[0];
    }

    public function logout(Request $request)
    {
        auth()->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    private function hasValidDomain($email)
    {
        return in_array(explode('@', $email)[1], ['meltwater.org'], true);
    }
}