<?php

class LinkedList
{
	private $firstNode = null, $lastNode = null;
	private $count = 0;

	public function add($object)
	{
		$newNode = new LinkedListNode($object, null);
		
		if($this->lastNode === null) 
			$this->firstNode = $this->lastNode = $newNode;

		else 
		{
			$this->lastNode->next = $newNode;
			$this->lastNode = $newNode;
		}

		$this->count++;
	}


	public function contains($object)
	{
		$node = $this->firstNode;
		while($node !== null)
			if($node->object === $object) return true;
			else $node = $node->next;
		return false;
	}


	public function count()
	{
		return $this->count;
	}


	public function remove($object)
	{
		$cur = $this->firstNode;
		$prev = null;
		
		while($cur !== null && $cur->object !== $object)
		{
			$prev = $cur;
			$cur = $cur->next;		
		}

		if($cur === null) return false;

		if($prev !== null)
			$prev->next = $cur->next;

		if($cur === $this->firstNode)
			$this->firstNode = $cur->next;

		if($this->firstNode === null)
			$this->lastNode = null;

		$this->count--;
	}
}


class LinkedListNode
{
	public $object;
	public $next;
	public function __construct($object, $next)
	{
		$this->object = $object;
		$this->next = $next;
	}
}