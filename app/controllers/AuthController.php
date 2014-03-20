<?php

use Cartalyst\Sentry\Checkpoints\NotActivatedException;
use Cartalyst\Sentry\Checkpoints\ThrottlingException;

class AuthController extends BaseController {

	/**
	 * Show the form for logging the user in.
	 *
	 * @return \Illuminate\View\View
	 */
	public function login()
	{
		return View::make('sentry.login');
	}

	/**
	 * Handle posting of the form for logging the user in.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function processLogin()
	{
		try
		{
			$input = Input::all();

			$rules = [
				'email'    => 'required|email',
				'password' => 'required',
			];

			$validator = Validator::make($input, $rules);

			if ($validator->fails())
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}

			$remember = (bool) Input::get('remember', false);

			if (Sentry::authenticate(Input::all(), $remember))
			{
				return Redirect::intended('account');
			}

			$errors = 'Invalid login or password.';
		}
		catch (NotActivatedException $e)
		{
			$errors = 'Account is not activated!';
		}
		catch (ThrottlingException $e)
		{
			$delay = $e->getDelay();

			$error = "Your account is blocked for {$delay} second(s).";
		}

		return Redirect::back()->withInput()->withErrors($errors);
	}

	/**
	 * Show the form for the user registration.
	 *
	 * @return \Illuminate\View\View
	 */
	public function register()
	{
		return View::make('sentry.register');
	}

	/**
	 * Handle posting of the form for the user registration.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function processRegistration()
	{
		$input = Input::all();

		$rules = [
			'email'            => 'required|email|unique:users',
			'password'         => 'required',
			'password_confirm' => 'required|same:password',
		];

		$validator = Validator::make($input, $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		if ($user = Sentry::register($input))
		{
			$code = Activation::create($user);

			$sent = Mail::send('sentry.emails.activate', compact('user', 'code'), function($m) use ($user)
			{
				$m->to($user->email)->subject('Activate Your Account');
			});

			if ( ! $sent)
			{
				return Redirect::to('register')->withErrors('Failed to send activation email.');
			}

			return Redirect::to("login")->withSuccess('An activation email has been sent.')->with('userId', $user->getUserId());
		}

		return Redirect::to('register')->withInput()->withErrors('Failed to register.');
	}

}
