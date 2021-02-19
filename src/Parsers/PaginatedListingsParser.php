<?php

namespace DD\Client\Core\Parsers;

use DD\Client\Core\Collection\Collection;

class PaginatedListingsParser extends ListingParser
{
	private $hasNextPage = false;
	private $hasPreviousPage = false;
	private $totalCount = false;

	public function parse($items)
	{
		if ($items && is_array($items)) {
			foreach ($items['edges'] as $item) {
				if (!empty($item['node'])) {
					$item = $item['node'];
				}
				$listingDetails = Parser::get_parser_for(ListingParser::class);
				$this->iterator->push($listingDetails->parse($item));
			}

			$this->hasNextPage = !empty($items['pageInfo']['hasNextPage']) ? (int)$items['pageInfo']['hasNextPage'] : 0;
			$this->hasPreviousPage = !empty($items['pageInfo']['hasPreviousPage']) ? (int)$items['pageInfo']['hasPreviousPage'] : 0;
			$this->totalCount = !empty($items['pageInfo']['totalCount']) ? (int)$items['pageInfo']['totalCount'] : 0;
		}
		return $this;
	}

	public function getHasNextPage()
	{
		return $this->hasNextPage === 1;
	}

	public function getHasPreviousPage()
	{
		return $this->hasPreviousPage === 1;
	}

	public function getTotalCount()
	{
		return $this->totalCount;
	}

	public function getIterator()
	{
		return $this->iterator;
	}
}
