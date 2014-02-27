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
			$rules = array(
				'email'    => 'required|email',
				'password' => 'required',
			);

			$validator = Validator::make(Input::get(), $rules);

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
		$rules = array(
			'email'            => 'required|email|unique:users',
			'password'         => 'required',
			'password_confirm' => 'required|same:password',
		);

		$validator = Validator::make(Input::get(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		if ($user = Sentry::register(Input::get()))
		{
			$code = Activation::create($user);

			return Redirect::to("reactivate/{$user->getUserId()}/{$code}");
		}

		return Redirect::to('register')->withInput()->withErrors('Failed to register.');
	}

}
