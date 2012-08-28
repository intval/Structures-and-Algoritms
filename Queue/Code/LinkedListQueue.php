<?php

class LinkedListQueue
{

	private $firstNode;
	private $lastNode;
	private $count;

	public function enqueue($value)
	{
		$newNode = new LinkedListQueueNode($value, null);

		if(null !== $this->lastNode)
			$this->lastNode->next = $newNode;
		else
			$this->firstNode = $newNode;

		$this->lastNode = $newNode;
		$this->count++;
	}

	public function dequeue()
	{
		if(null === $this->firstNode)
			throw new OutOfBoundsException("Cannot dequeue an empty queue");

		if(null === $this->firstNode->next )
			$this->lastNode = null;

		$data = $this->firstNode->object;
		$this->firstNode = $this->firstNode->next;
		$this->count--;
		return $data;
	}

	public function count()
	{
		return $this->count;
	}
}

class LinkedListQueueNode
{
	public $object;
	public $next;
	public function __construct($object, $next)
	{
		$this->object = $object;
		$this->next = $next;
	}
}