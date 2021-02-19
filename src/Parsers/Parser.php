<?php

namespace DD\Client\Core\Parsers;

use DD\Client\Core\Collection\Collection;
use SilverStripe\ORM\ArrayList;

/**
 * Class Parser
 * @package DD\Client\Core\Parsers
 *
 * @property Collection|ArrayList iterator
 */
abstract class Parser
{
	private static $parsers = [];
	
    protected $iterator;

    public function __construct()
    {
        $this->iterator = new Collection();
    }

	public static function register_parser($type, $newType)
	{
		self::$parsers[$type] = $newType;
	}

	/**
	 * @param $type
	 * @return Parser
	 */
	public static function get_parser_for($type)
	{
		if (!empty(self::$parsers[$type])) {
			$type = self::$parsers[$type];
		}
		return new $type();
	}

    /**
     * @param $collection
     * @return Collection|ArrayList
     */
	public abstract function parse($collection);

	public function First()
    {
        return $this->iterator->first();
    }

	public function Last()
    {
        return $this->iterator->last();
    }
}
