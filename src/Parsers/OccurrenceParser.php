<?php

namespace DD\Client\Core\Parsers;

class OccurrenceParser extends Parser
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
