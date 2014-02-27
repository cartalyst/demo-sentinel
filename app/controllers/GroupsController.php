<?php

class GroupsController extends AuthController {

	/**
	 * Holds the Sentry Groups repository.
	 *
	 * @var \Cartalyst\Sentry\Groups\EloquentGroup
	 */
	protected $groups;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->groups = Sentry::getGroupRepository()->createModel();
	}

	/**
	 * Display a listing of groups.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$groups = $this->groups->paginate();

		return View::make('sentry.groups.index', compact('groups'));
	}

	/**
	 * Show the form for creating new group.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new group.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating group.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating group.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified group.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		if ($group = $this->groups->find($id))
		{
			$group->delete();

			return Redirect::to('groups');
		}

		return Redirect::to('groups');
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
			if ( ! $group = $this->groups->find($id))
			{
				return Redirect::to('groups');
			}
		}
		else
		{
			$group = $this->groups;
		}

		return View::make('sentry.groups.form', compact('mode', 'group'));
	}

	/**
	 * Processes the form.
	 *
	 * @param  string  $mode
	 * @param  int     $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function processForm($mode, $id)
	{
		$input = Input::all();

		$rules = array(
			'name' => 'required',
			'slug' => 'required|unique:groups'
		);

		if ($id)
		{
			$group = $this->groups->find($id);

			$rules['slug'] .= ",slug,{$group->slug},slug";

			$messages = $this->validateGroup($input, $rules);

			if ($messages->isEmpty())
			{
				$group->fill($input);

				$group->save();
			}
		}
		else
		{
			$messages = $this->validateGroup($input, $rules);

			if ($messages->isEmpty())
			{
				$group = $this->groups->create($input);
			}
		}

		if ($messages->isEmpty())
		{
			return Redirect::to('groups');
		}

		return Redirect::back()->withInput()->withErrors($messages);
	}

	/**
	 * Validates a group.
	 *
	 * @param  array  $data
	 * @param  mixed  $id
	 * @return \Illuminate\Support\MessageBag
	 */
	protected function validateGroup($data, $rules)
	{
		$validator = Validator::make($data, $rules);

		$validator->passes();

		return $validator->errors();
	}

}
