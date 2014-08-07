<?php

use Cartalyst\Sentinel\Persistences\EloquentPersistence;

class Persistence extends EloquentPersistence {

	/**
	 * {@inheritDoc}
	 */
	protected $guarded = [];

	/**
	 * {@inheritDoc}
	 */
	protected $appends = [
		'last_used',
	];

	/**
	 * {@inheritDoc}
	 */
	public function __construct(array $attributes = array())
	{
		$browser = new Browser;

		$attributes['version']  = $browser->getVersion();
		$attributes['platform'] = $browser->getPlatform();
		$attributes['browser']  = $browser->getBrowser();

		parent::__construct($attributes);
	}

	/**
	 * Last used accessor.
	 *
	 * @param  mixed  $value
	 * @return string
	 */
	public function getLastUsedAttribute($value)
	{
		$lastUsed = $this->updated_at;

		$diff = $lastUsed->diffInMinutes();

		switch ($diff)
		{
			case 0:
				$value = 'now.';
				break;

			case $diff > 60 && $diff <= 1440:
				$value = $lastUsed->diffInHours() . ' hours ago.';
				break;

			case $diff <= 60:
				$value = $lastUsed->diffInMinutes() . ' mintues ago.';
				break;

			case $diff > 1440 && $diff < 44640:
				$value = $lastUsed->diffInDays() . ' days ago.';
				break;

			case $diff >= 44640 && $diff < 525949:
				$value = $lastUsed->diffInMonths() . ' months ago.';
				break;

			case $diff > 525949:
				$value = $lastUsed->diffInYears() . ' years ago.';
				break;

			default:
				$value = $lastUsed->diffInSeconds() . ' seconds ago.';
				break;
		}

		return $value;
	}

}
