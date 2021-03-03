<?php

namespace DD\Client\Core\Parsers;

use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\ORM\FieldType\DBField;

class ListingParser extends Parser
{
	public function parserData($data)
	{
	    $this->processBasicData($data);
		$this->processCategories($data);
		$this->processGalleryImages($data);
		$this->processImage($data);
		$this->processMainImage($data);
		$this->processLogoImage($data);
		$this->processMainCategory($data);
		$this->processOccurences($data);
		$this->processFiles($data);
		return $data;
	}

	public function parse($data)
	{
		return $this->parserData($data);
	}

	public function processBasicData(&$data)
	{
		if (!empty($data['Website'])) {
		    $pathInfo = parse_url($data['Website']);
		    if (!empty($pathInfo['host'])) {
		        $data['WebsiteDisplay'] = $pathInfo['host'];
            }
		}
		if (!empty($data['CurrentStartDate'])) {
            $data['CurrentStartDate'] = DBField::create_field('Datetime', $data['CurrentStartDate']);
		}
	}

	public function processCategories(&$data)
	{
		if (!empty($data['Categories'])) {
			$parser = Parser::get_parser_for(CategoryParser::class);
			$data['Categories'] = $parser->parse($data['Categories']['edges']);
		}
	}

	public function processGalleryImages(&$data)
	{
		if (!empty($data['GalleryImages'])) {
			$images = [];
			foreach ($data['GalleryImages']['edges'] as $image) {
				$images[] = $image['node'];
			}
			$data['GalleryImages'] = $images;
		}
	}

	public function processImage(&$data)
	{
	}

	public function processMainImage(&$data)
	{
	}

	public function processLogoImage(&$data)
	{
	}

	public function processFiles(&$data)
	{
	}

	public function processMainCategory(&$data)
	{
	}

	public function processOccurences(&$data)
	{
		if (!empty($data['Occurrences'])) {
			$parser = Parser::get_parser_for(OccurrenceParser::class);
			$data['Occurrences'] = $parser->parse($data['Occurrences']);
		}
		if (!empty($data['FutureOccurrences'])) {
			$parser = Parser::get_parser_for(OccurrenceParser::class);
			$data['FutureOccurrences'] = $parser->parse($data['FutureOccurrences']);
		}
		if (!empty($data['PastOccurrences'])) {
			$parser = Parser::get_parser_for(OccurrenceParser::class);
			$data['PastOccurrences'] = $parser->parse($data['PastOccurrences']);
		}
	}
}
