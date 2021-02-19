<?php

namespace DD\Client\Core\Parsers;

use DD\Client\Core\Collection\Collection;

class CategoryParser extends Parser
{
	public function parse($items)
	{
		if (is_array($items)) {
			foreach ($items as $item) {
				if (!empty($item['node'])) {
					$item = $item['node'];
				}
				$children = null;
				if (!empty($item['Children'])) {
					$childrenParser = Parser::get_parser_for(CategoryParser::class);
					$children = $childrenParser->parse($item['Children']['edges']);
				}

				if ($children) {
					$item['Children'] = $children;
				} else {
					unset($item['Children']);
				}
				$this->iterator->push($item);
			}
		}
		return $this->iterator;
	}
}
