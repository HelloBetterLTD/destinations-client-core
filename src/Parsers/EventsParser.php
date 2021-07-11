<?php


namespace DD\Client\Core\Parsers;


class EventsParser extends Parser
{
    public function parse($items)
    {
        if ($items && is_array($items)) {
            foreach ($items as $item) {
                $listingDetails = Parser::get_parser_for(EventParser::class);
                $this->iterator->push($listingDetails->parse($item));
            }
        }
        return $this->iterator;
    }

}