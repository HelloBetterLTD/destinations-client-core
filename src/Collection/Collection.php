<?php

namespace DD\Client\Core\Collection;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

class Collection implements ArrayAccess, Countable, IteratorAggregate
{
	protected $items = [];

	public function getIterator()
	{
		return new ArrayIterator($this->items);
	}

	public function toArray()
	{
		return $this->items;
	}

	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->items);
	}

	public function offsetGet($offset)
	{
		if ($this->offsetExists($offset)) {
			return $this->items[$offset];
		}
		return null;
	}

	public function offsetUnset($offset)
	{
		unset($this->items[$offset]);
	}

	public function count()
	{
		return count($this->items);
	}

	public function offsetSet($offset, $value)
	{
		if ($offset == null) {
			$this->items[] = $value;
		} else {
			$this->items[$offset] = $value;
		}
	}

	public function push($item)
	{
		$this->items[] = $item;
	}

	public function pop()
	{
		return array_pop($this->items);
	}

	public function unshift($item)
	{
		array_unshift($this->items, $item);
	}

	public function shift()
	{
		return array_shift($this->items);
	}

	public function first()
	{
		if (empty($this->items)) {
			return null;
		}

		return reset($this->items);
	}

	public function last()
	{
		if (empty($this->items)) {
			return null;
		}

		return end($this->items);
	}

}