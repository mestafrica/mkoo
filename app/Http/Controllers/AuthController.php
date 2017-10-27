<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Entities\User;


class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) {

            if (auth()->user()->isEit()) {
                return redirect()->route('orders.index');
            }

            return redirect()->route('home');
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

        } catch (\Exception $exception) {
            logger('Exception occurred whiles signing in', compact('exception'));

            flash()->error('An error occurred. Please check to make sure you have a working internet connection.');

            return redirect()->route('login');
        }

        $user = $this->findOrCreateUser($googleUserProfile);

        auth()->login($user, true);

        flash()->success('Welcome back, '. $user->getFirstName());

        return redirect()->route('home');
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
            'first_name' => $this->getUserFirstName($googleUser),
            'last_name' => $this->getUserLastName($googleUser),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->avatar_original,
            'gender' => $this->getGender($googleUser),
            'last_login' => Carbon::now()
        ]);
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

    private function getUserLastName($googleUser)
    {
        return $googleUser->getRaw()['name']['familyName'];
    }

    private function getUserFirstName($googleUser)
    {
        return $googleUser->getRaw()['name']['givenName'];
    }

    private function getGender($googleUser)
    {
        return $googleUser->getRaw()['gender'] ?? null;
    }
}