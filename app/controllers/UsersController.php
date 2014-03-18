<?php

class UsersController extends AuthorizedController {

	/**
	 * Holds the Sentry Users repository.
	 *
	 * @var \Cartalyst\Sentry\Users\EloquentUser
	 */
	protected $users;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->users = Sentry::getUserRepository();
	}

	/**
	 * Display a listing of users.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$users = $this->users->createModel()->paginate();

		return View::make('sentry.users.index', compact('users'));
	}

	/**
	 * Show the form for creating new user.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new user.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating user.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		if ($user = $this->users->createModel()->find($id))
		{
			$user->delete();

			return Redirect::to('users');
		}

		return Redirect::to('users');
	}

	/**
	 * Shows the form.
	 *
	 * @param  string  $mode
	 * @param  int     $id
	 * @return mixed
	 */
	protected function showForm($mode, $id = null)
	{
		if ($id)
		{
			if ( ! $user = $this->users->createModel()->find($id))
			{
				return Redirect::to('users');
			}
		}
		else
		{
			$user = $this->users->createModel();
		}

		return View::make('sentry.users.form', compact('mode', 'user'));
	}

	/**
	 * Processes the form.
	 *
	 * @param  string  $mode
	 * @param  int     $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function processForm($mode, $id = null)
	{
		$input = array_filter(Input::all());

		$rules = [
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|unique:users'
		];

		if ($id)
		{
			$user = $this->users->createModel()->find($id);

			$rules['email'] .= ",email,{$user->email},email";

			$messages = $this->validateUser($input, $rules);

			if ($messages->isEmpty())
			{
				$this->users->update($user, $input);
			}
		}
		else
		{
			$messages = $this->validateUser($input, $rules);

			if ($messages->isEmpty())
			{
				$user = $this->users->create($input);

				$code = Activation::create($user);

				Activation::complete($user, $code);
			}
		}

		if ($messages->isEmpty())
		{
			return Redirect::to('users');
		}

		return Redirect::back()->withInput()->withErrors($messages);
	}

	/**
	 * Validates a user.
	 *
	 * @param  array  $data
	 * @param  mixed  $id
	 * @return \Illuminate\Support\MessageBag
	 */
	protected function validateUser($data, $rules)
	{
		$validator = Validator::make($data, $rules);

		$validator->passes();

		return $validator->errors();
	}

}
