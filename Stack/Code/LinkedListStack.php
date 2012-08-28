<?php

class LinkedListStack
{
	private $lastNode = null;
	private $count = 0;

	public function push($val)
	{
		$this->lastNode = new LinkedListNode($val, $this->lastNode);
		$this->count++;
	}

	public function pop()
	{
		if(null === $this->lastNode)
			throw new OutOfBoundsException("Can't pop an empty stack");

		$lastValue = $this->lastNode->object;
		$this->lastNode = $this->lastNode->prev;
		$this->count--;
		return $lastValue;
	}

	public function count()
	{
		return $this->count;
	}
}

class LinkedListNode
{
	public $object;
	public $prev;
	public function __construct($object, $prev)
	{
		$this->object = $object;
		$this->prev = $prev;
	}
}