<?php

namespace DD\Client\Core\Parsers;

use DD\Client\Core\Collection\Collection;

class RegionParser extends Parser
{
	public function parse($items)
	{
		if ($items && is_array($items)) {
			foreach ($items as $item) {
				$this->iterator->push($item);
			}
		}
		return $this->iterator;
	}
}
