<?php

namespace DD\Client\Core;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class QueryLoader
{
	const CATEGORIES = 'categories';
	const LISTINGS = 'listings';
	const LISTINGS_BY_ID = 'listings_by_id';
	const REGIONS = 'regions';
	const LOCATIONS = 'locations';
	const LISTING = 'listing';
	const LISTINGS_SEARCH = 'listings_search';
	const LISTING_TAGS = 'listingtags';
	const UPCOMING_EVENTS = 'upcomingevents';
	const TODAYS_EVENTS = 'todaysevents';

	private static $register_queries = [];

	protected static function default_path()
	{
		$path = implode(
			DIRECTORY_SEPARATOR,
			[
				dirname(dirname(__FILE__)),
				'gql'
			]
		);
		return $path;
	}

	public static function register_query($name, $path)
	{
		if (file_exists($path)) {
			self::$register_queries[$name] = $path;
		} else {
			throw new FileNotFoundException(
				sprintf('Error registering query %s, on %s', $name, __FUNCTION__)
			);
		}
	}

	public static function get_query_for($name)
	{
		$path = null;
		if (array_key_exists($name, self::$register_queries) && !empty(self::$register_queries[$name])) {
			$path = self::$register_queries[$name];
		}

		if (empty($path)) {
			$path = implode(
				DIRECTORY_SEPARATOR,
				[
					self::default_path(),
					$name . '.gql'
				]
			);
		}

		if (!file_exists($path)) {
			throw new FileNotFoundException(
				sprintf('Error GraphQL file not found for %s "%s"', $name, $path)
			);
		}
		return file_get_contents($path);
	}

}
