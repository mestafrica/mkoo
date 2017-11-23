<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Jobs\AddUserJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{

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

            $this->hasValidDomain($googleUserProfile->email);

            if (! $this->hasValidDomain($googleUserProfile->email)) {
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

        flash()->success('Welcome back, ' . $user->getFirstName());

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

        $request = new Request([
            'first_name' => $this->getUserFirstName($googleUser),
            'last_name' => $this->getUserLastName($googleUser),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->avatar_original,
            'gender' => $this->getGender($googleUser),
            'last_login' => Carbon::now()
        ]);

        return $this->dispatch(new AddUserJob($request));
    }

    private function hasValidDomain($email)
    {
        return in_array(explode('@', $email)[1], config('mkoo.allowed_domains'), true);
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
