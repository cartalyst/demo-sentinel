<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();
		DB::table('groups')->truncate();

		$group = [
			'name' => 'Administrator',
			'slug' => 'administrator',
			'permissions' => [
				'admin' => true,
			]
		];

		$adminGroup = Sentry::getGroupRepository()->createModel()->fill($group)->save();

		$subscribersGroup = [
			'name' => 'Subscribers',
			'slug' => 'subscribers',
		];

		Sentry::getGroupRepository()->createModel()->fill($subscribersGroup)->save();

		$admin = [
			'email'    => 'admin@example.com',
			'password' => 'password',
		];

		$users = [

			[
				'email'    => 'demo1@example.com',
				'password' => 'demo123',
			],

			[
				'email'    => 'demo2@example.com',
				'password' => 'demo123',
			],

			[
				'email'    => 'demo3@example.com',
				'password' => 'demo123',
			],

		];

		$adminUser = Sentry::registerAndActivate($admin);
		$adminUser->groups()->attach($adminGroup);

		foreach ($users as $user)
		{
			Sentry::registerAndActivate($user);
		}
	}

}
