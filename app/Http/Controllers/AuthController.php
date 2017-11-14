<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Entities\User;
use App\Jobs\RegisterUser;
use App\Jobs\CustomLogin;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
        mkoo_flash('Welcome back '.$user->getFirstName(), 'success');
        // flash()->success('Welcome back, '. $user->getFirstName());

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


    /**
     * Logout user && destroy sessions
     *
     * @param $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        auth()->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Get list of all users
     *
     * @param $request
     * @return mixed
     */
    public function users(Request $request)
    {
        return view('auth.users')->with('users', User::all());
    }


    /**
     * Handle email/password logins
     *
     * @param $request
     * @return mixed
     */
    public function handleCustomLogin(Request $request)
    {
        $params = $request->all();

        $errors = isValidCred($params, "login");


         $failedLogin = function () use ($params, $errors) {
            mkoo_flash("Sorry we couldn't log you in :(", 'error');
            return view('auth.login')->withErrors($errors)
                    ->with('user', (object)$params);
            ;
         };

        $login = function () use ($params, $failedLogin) {
            try {
                $this->dispatch(new CustomLogin($params));
                mkoo_flash('Welcome back '.auth()->user()->first_name, 'success');
                return $this->login();
            } catch (\Exception $exception) {
                logger(
                    'Exception occurred during email/password sign in',
                    (array)$exception
                );
                $failedLogin();
            }
            return $this->login();
        };


        return ($errors == false)? $login() :$failedLogin($errors);
    }


    /**
     * Register new users
     *
     * @param $request
     * @return mixed
     */
    public function register()
    {
        $user = new User();
        return view('auth.create')->with('user', $user);
    }



    public function store(Request $request)
    {
        $params = $request->all();

        $errors = isValidCred($params, "signup");

         $failedRegistration = function ($errors = []) use ($params) {
            mkoo_flash("Sorry user could not be added", "error");
            $params['exists'] = true;
            return view('auth.create')->withErrors($errors)
            ->with('user', (object)$params);
         };

        $createUser = function () use ($params, $failedRegistration) {
            mkoo_flash("User added successfully", "success");
            try {
                $this->dispatch(new registerUser($params));
            } catch (\Exception $exception) {
                $failedRegistration();
                logger(
                    'Exception occurred during email/password sign up',
                    $exception
                );
            }
            return redirect(route('auth.users'));
        };

       

        return ($errors === false) ? $createUser() :
        $failedRegistration($errors);
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
