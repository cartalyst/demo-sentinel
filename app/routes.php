<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('logout', function()
{
	Sentry::logout();

	return Redirect::to('/');
});

Route::group(['prefix' => 'groups'], function()
{
	Route::get('/', 'GroupsController@index');
	Route::get('create', 'GroupsController@create');
	Route::post('create', 'GroupsController@store');
	Route::get('{id}', 'GroupsController@edit');
	Route::post('{id}', 'GroupsController@update');
	Route::get('{id}/delete', 'GroupsController@delete');
});

Route::group(['prefix' => 'users'], function()
{
	Route::get('/', 'UsersController@index');
	Route::get('create', 'UsersController@create');
	Route::post('create', 'UsersController@store');
	Route::get('{id}', 'UsersController@edit');
	Route::post('{id}', 'UsersController@update');
	Route::get('{id}/delete', 'UsersController@delete');
});

Route::get('/', function()
{
	return View::make('sentry/index');
});

Route::get('login', 'AuthController@login');
Route::post('login', 'AuthController@processLogin');

Route::get('register', 'AuthController@register');
Route::post('register', 'AuthController@processRegistration');



Route::get('wait', function()
{
	return View::make('sentry.wait');
});

Route::get('activate/{id}/{code}', function($id, $code)
{
	$user = Sentry::findById($id);

	if ( ! Activation::complete($user, $code))
	{
		return Redirect::to("login")
			->withErrors('Invalid or expired activation code.');
	}

	return Redirect::to('login')->withSuccess('Account activated.');
})->where('id', '\d+');

Route::get('reactivate', function()
{
	if ( ! $user = Sentry::check())
	{
		return Redirect::to('login');
	}

	$activation = Activation::exists($user) ?: Activation::create($user);

	$code = $activation->code;

	$sent = Mail::send('sentry.emails.activate', compact('user', 'code'), function($m) use ($user)
	{
		$m->to($user->email)->subject('Activate Your Account');
	});

	if ( ! $sent)
	{
		return Redirect::to('register')->withErrors('Failed to send activation email.');
	}

	return Redirect::to('wait');
})->where('id', '\d+');

Route::get('deactivate', function()
{
	$user = Sentry::check();

	Activation::remove($user);

	return Redirect::back();
});

Route::get('reset', function()
{
	return View::make('sentry.reset.begin');
});

Route::post('reset', function()
{
	$rules = [
		'email' => 'required|email',
	];

	$validator = Validator::make(Input::get(), $rules);

	if ($validator->fails())
	{
		return Redirect::back()
			->withInput()
			->withErrors($validator);
	}

	$email = Input::get('email');

	$user = Sentry::findByCredentials(compact('email'));

	if ( ! $user)
	{
		return Redirect::back()
			->withInput()
			->withErrors('No user with that email address belongs in our system.');
	}

	$reminder = Reminder::exists($user) ?: Reminder::create($user);

	$code = $reminder->code;

	$sent = Mail::send('sentry.emails.reminder', compact('user', 'code'), function($m) use ($user)
	{
		$m->to($user->email)->subject('Activate Your Account');
	});

	if ( ! $sent)
	{
		return Redirect::to('register')
			->withErrors('Failed to send reset password email.');
	}

	return Redirect::to('wait');
});

Route::get('reset/{id}/{code}', function($id, $code)
{
	$user = Sentry::findById($id);

	return View::make('sentry.reset.complete');

})->where('id', '\d+');

Route::post('reset/{id}/{code}', function($id, $code)
{
	$rules = [
		'password' => 'required|confirmed',
	];

	$validator = Validator::make(Input::get(), $rules);

	if ($validator->fails())
	{
		return Redirect::back()
			->withInput()
			->withErrors($validator);
	}

	$user = Sentry::findById($id);

	if ( ! $user)
	{
		return Redirect::back()
			->withInput()
			->withErrors('The user no longer exists.');
	}

	if ( ! Reminder::complete($user, $code, Input::get('password')))
	{
		return Redirect::to('login')
			->withErrors('Invalid or expired reset code.');
	}

	return Redirect::to('login')->withSuccess("Password Reset.");

})->where('id', '\d+');

Route::group(['prefix' => 'account', 'before' => 'auth'], function()
{

	Route::get('/', function()
	{
		$user = Sentry::getUser();
		$persistence = Sentry::getPersistence();
		$activationCode = '';

		if ( ! $user->isActivated())
		{
			$activationCode = Activation::exists($user);
		}

		return View::make('sentry.account.home', compact('user', 'persistence', 'activationCode'));
	});

	Route::get('kill/{code}', function($code)
	{
		$user = Sentry::getUser();
		$user->removePersistenceCode($code);
		$user->save();

		return Redirect::back();
	});

});

Route::group(['prefix' => 'swipe'], function()
{
	Route::get('register', function()
	{
		$login = Session::get('login');
		$code = Session::get('code');

		if ( ! $login or ! $code)
		{
			return Redirect::to('login')
				->withErrors('Missing Swipe Identity swipe login or code.');
		}

		Session::reflash();

		return View::make('sentry.swipe.register', compact('login', 'code'));
	});

	Route::get('registered', function()
	{
		$email = Input::old('email');
		$password = Input::old('password');

		if ( ! $email or ! $password)
		{
			return Redirect::to('email')
				->withErrors('Email or password have disappeared from the session.');
		}

		Session::reflash();

		$user = Sentry::authenticate(compact('email', 'password'));

		if ( ! $user)
		{
			return Redirect::to('login')
				->withInput()
				->withErrors('Login failed even after swipe was registered. Potential infinite loop.');
		}

		return Redirect::to('account');
	});

	Route::group(['prefix' => 'sms'], function()
	{
		Route::get('register', function()
		{
			$email = Input::old('email');
			$password = Input::old('password');

			if ( ! $email or ! $password)
			{
				return Redirect::to('login')
					->withErrors('Email or password have disappeared from the session.');
			}

			Session::reflash();

			return View::make('sentry.swipe.sms.register');
		});

		Route::post('register', function()
		{
			$rules = [
				'number' => 'required|regex:/^\+?\d+$/|confirmed',
			];

			$validator = Validator::make(Input::get(), $rules);

			Session::reflash();

			if ($validator->fails())
			{
				return Redirect::back()
					->withErrors($validator);
			}

			$email = Input::old('email');
			$password = Input::old('password');

			if ( ! $email or ! $password)
			{
				return Redirect::to('login')
					->withErrors('Email or password have disappeared from the session.');
			}

			$user = Sentry::findByCredentials(compact('email', 'password'));

			if ( ! $user)
			{
				return Redirect::to('login')
					->withInput()
					->withErrors('User in session does not exist.');
			}

			$response = SwipeIdentity::saveNumber($user, Input::get('number'));

			if ( ! $response)
			{
				return Redirect::to('login')
					->withErrors('Failed to send number to Swipe Identity.');
			}

			// We should expect another exception
			Sentry::authenticate(compact('email', 'password'));

			// We should never get here
			return Redirect::to('login')
				->withErrors('Something went wrong.');
		});

		Route::get('code', function()
		{
			$email = Input::old('email');
			$password = Input::old('password');

			if ( ! $email or ! $password)
			{
				return Redirect::to('login')
					->withErrors('Email or password have disappeared from the session.');
			}

			Session::reflash();

			return View::make('sentry.swipe.sms.code');
		});

		Route::post('code', function()
		{
			$rules = [
				'code' => 'required',
			];

			$validator = Validator::make(Input::get(), $rules);

			Session::reflash();

			if ($validator->fails())
			{
				return Redirect::back()
					->withErrors($validator);
			}

			$email = Input::old('email');
			$password = Input::old('password');

			if ( ! $email or ! $password)
			{
				return Redirect::to('login')
					->withErrors('Email or password have disappeared from the session.');
			}

			$user = Sentry::findByCredentials(compact('email', 'password'));

			if ( ! $user)
			{
				return Redirect::to('login')
					->withInput()
					->withErrors('User in session does not exist.');
			}

			$user = SwipeIdentity::checkAnswer($user, Input::get('code'), function($user)
			{
				return Sentry::authenticate($user, (bool) Input::old('remember', false));
			});

			if ( ! $user)
			{
				return Redirect::to('login')
					->withInput()
					->withErrors('Invalid code.');
			}

			return Redirect::to('account');
		});
	});
});
