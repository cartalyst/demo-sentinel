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

		$adminGroup = Sentinel::getGroupRepository()->createModel()->fill($group)->save();

		$subscribersGroup = [
			'name' => 'Subscribers',
			'slug' => 'subscribers',
		];

		Sentinel::getGroupRepository()->createModel()->fill($subscribersGroup)->save();

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

		$adminUser = Sentinel::registerAndActivate($admin);
		$adminUser->groups()->attach($adminGroup);

		foreach ($users as $user)
		{
			Sentinel::registerAndActivate($user);
		}
	}

}
