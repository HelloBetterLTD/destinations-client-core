<?php

namespace DD\Client\Core\Parsers;

use DD\Client\Core\Collection\Collection;

class ListingsParser extends Parser
{
    public function parse($items)
    {
        if ($items && is_array($items)) {
            foreach ($items as $item) {
                $listingDetails = Parser::get_parser_for(ListingParser::class);
                $this->iterator->push($listingDetails->parse($item));
            }
        }
        return $this->iterator;
    }
}
